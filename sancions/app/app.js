/*jslint browser:true, devel:true, white:true, vars:true, eqeq:true */
/*global $:false, intel:false, Mustache:false*/
/*
 * Copyright (c) 2012, Intel Corporation. All rights reserved.
 * File revision: 15 October 2012
 * Please see http://software.intel.com/html5/license/samples 
 * and the included README.md file for license terms and conditions.
 */

var onDeviceReady=function(){                             // called when Cordova is ready
   if( window.Cordova && navigator.splashscreen ) {     // Cordova API detected
        navigator.splashscreen.hide() ;                 // hide splash screen
    }
} ;
document.addEventListener("deviceready", onDeviceReady, false) ;



/* manage data needed for app (movies from Rotten Tomatoes web API) */
var dataSource = {
    
    /* developer key to access Rotten Tomatoes web APIs */
    key: '',
    
    /* base url for all Rotten Tomatoes web APIs */
    baseurl: 'http://api.rottentomatoes.com/api/public/v1.0/',
    
    /* locally cached data */
    data: [],
    
    /* number of total movies */
    nItems: -1,
    
    /* initialize data source */
    init: function(key, nItemsPerPage) {
        dataSource.key = key;
        dataSource.nItemsPerPage = nItemsPerPage;
    },
    
    /* check to see if developer key is valid */
    validateKey: function() {
        /* piggy back off of movie data request to get done/fail callback */
        return dataSource.getMovies(1);
    },
    
    /* flush cached data */
    flush: function() {
        dataSource.data = [];
        dataSource.nItems = -1;
    },
    
    /* get total number of movies */
    getNumMovies: function() {
        /* look for cached data first */
        if (dataSource.nItems != -1) {
            return $.Deferred().resolve(dataSource.nItems);
        } 
        /* otherwise request data from remote web api */
        else {
            /* piggy back off of movie data request to get total number of movies */
            return dataSource.getMovies(1).pipe(function(data) {
                return dataSource.nItems;    
            });
        }
    },
    
    /* get data for all movies of given page */
    getMovies: function(page) {
        /* look for cached data first */
        if (page in dataSource.data) {
            return $.Deferred().resolve(dataSource.data[page]);
        }
        
        /* otherwise request data from remote web api */
        else {
            /* issue cross-domain jsonp request to get given page of movie data */
            return $.jsonp({
                /* request URL to obtain current releases data from Rotten Tomatoes API */
                url: dataSource.baseurl + 'lists/dvds/current_releases.json',
                /* parameters to send as part of request */
                data: { 
                    page: page, 
                    page_limit: dataSource.nItemsPerPage,
                    apikey: dataSource.key 
                },
                /* parameter name for appending callback name to request */
                callbackParameter: 'callback'
            })
            /* do some bookkeeping & data cleansing before returning movie data */
            .pipe(function(data) {
                /* record total number of movies available (only necessary on first request) */
                if (page == 1) {
                    dataSource.nItems = data.total;
                }
                /* clean up data from remote source to apply our app-specific data format */
                dataSource.cleanupData(data.movies);
                /* cache results for future queries */
                dataSource.data[page] = data.movies;
                /* return movie data */
                return data.movies;
            });
        }
    },
    
    /* get (cached) data for given movie, identified by its page & index on the page */
    getMovie: function(page, index) {
        return dataSource.data[page][index];
    },
    
    /* clean up data from remote source to apply our app-specific data format */
    cleanupData: function(data) {
        $.each(data, function(index, value) {
            /* use more human-readable "N/A" when rating is not available */
            if (value.ratings.critics_score == -1) {
                value.ratings.critics_score = "N/A";
            } 
            /* add % unit to rating data */
            else {
                value.ratings.critics_score += "%";
            }
        });
    }
};


/* manage creation of views (and one-time binding of data to each view) */
var viewController = {
    
    /* total number of pages */
    nPrimaryPagesTotal: 0,
    
    /* total number of page skeletons created so far */
    nPrimaryPagesInit: 0,
    
    /* total number of pages created (with content) so far */
    nPrimaryPagesCreated: 0,
    
    /* number of movies displayed on each page (constant) */
    N_ITEMS_PER_PAGE: 12,    
    
    /* set of pages that need to be recreated upon refresh */
    pagesToRecreate: {},
    
    /* get developer key before the app can even start */
    preinit: function() {
        $('#login').submit(function() {
            /* get key from input screen */
            var key = $('#devkey').val();
            /* initialize data source with key (and number of items to fetch per page) */
            dataSource.init(key, viewController.N_ITEMS_PER_PAGE);
            /* put up spinner while testing key */
            $.mobile.showPageLoadingMsg();
            /* test developer key */
            dataSource.validateKey()
                /* start app if key is valid */
                .done(function() {
                    viewController.init();
                })
                /* clear input, display error message, and try again */
                .fail(function() {
                    $('#devkey').val('');
                    $.mobile.hidePageLoadingMsg();
                    $('#wrongkey').html(key);
                    $.mobile.changePage( '#loginErrorMsg', { role: 'dialog' } );
                });
            
            return false;
        });
    },
    
    /* initialize app upon start */
    init: function() {
        
        /* get templates for creating page skeletons & data-bound content */
        viewController.primaryPageSkeletonTmpl = $('#primaryPageSkeletonTmpl').html();
        viewController.primaryPageContentTmpl = $('#primaryPageContentTmpl').html();
        viewController.secondaryPageContentTmpl = $('#secondaryPageContentTmpl').html();
        
        /* handle refresh command from user */
        $(document).on('click', '.refreshBtn', function(event) {
            viewController.refresh();
        });
        
        /* create pages on demand */
        $(document).on('pageinit', '.primaryPage', viewController.createPrimaryPage);
        $(document).on('click', '.movies > li', viewController.createSecondaryPage);
        
        /* initialize all primary pages */
        viewController.initPrimaryPages();  
        
    },
    
    /* reset all views to get newest data */
    refresh: function() {
        
        /* clear all primary page content */
        $('.primaryPage')
            .find(':jqmData(role=content)').html('').end()
            .find(':jqmData(role=footer)').hide();
        
        /* while still resetting and loading data, show spinner */
        $.mobile.showPageLoadingMsg();
                
        /* flush cache data */
        dataSource.flush();
        
        /* track any new page that need to be recreated */
        for (var i = 1; i <= viewController.nPrimaryPagesCreated; i++) {
            viewController.pagesToRecreate[i] = true;
        }
        
        /* recreate when navigating to refreshed page */
        $(document).bind('pagebeforechange', function(e, data) {
            if (typeof data.toPage !== 'string') {
                var page = data.toPage.attr('id');
                if (page in viewController.pagesToRecreate) {
                    /* bookkeeping to only recreate once per refreshed page */
                    delete viewController.pagesToRecreate[page];
                    /* no longer need to listen to pagebeforechange when no more pages to recreate */
                    if ($.isEmptyObject(viewController.pagesToRecreate)) {
                        $(document).unbind('pagebeforechange');
                    }
                    /* recreate page */
                    data.toPage.trigger('pageinit');
                }
            }
        });

        /* reset number of pages created */
        viewController.nPrimaryPagesCreated = 0;
                
        /* navigate back to the first page */
        $.mobile.changePage('#1');
        
        /* create/update all necessary primary pages */
        var npages = viewController.nPrimaryPagesTotal;
        viewController.initPrimaryPages().done(function() {
            /* update navigation if number of pages changed across refresh */
            if (viewController.nPrimaryPagesTotal > npages) {
                $('#' + npages).find('.next')
                    .attr('href', '#' + (npages + 1))
                    .removeClass('ui-disabled');
            } else if (viewController.nPrimaryPagesTotal < npages) {
                $('#'+ npages).find('.next').addClass('ui-disabled');
            }
        });
    },
    
    /* create all primary page skeletons, insert into dom & load default page */
    initPrimaryPages: function() {
        
        /* get total number of movies (this may involve asking remote data source, hence callback necessary) */
        return dataSource.getNumMovies().done(function(nmovies) {
            
            /* calculate number of pages */
            viewController.nPrimaryPagesTotal = Math.ceil(nmovies / viewController.N_ITEMS_PER_PAGE);
            
            /* need to create additional page skeletons */
            if (viewController.nPrimaryPagesInit < viewController.nPrimaryPagesTotal) {
                
                /* create additional page skeletons */
                var $pages = $();
                for (var pagenum = viewController.nPrimaryPagesInit + 1; pagenum <= viewController.nPrimaryPagesTotal; pagenum++) {
                    $pages = $pages.add(viewController.initPrimaryPage(pagenum));
                }
                $pages.insertBefore('#loginPage');
                
                /* update the number of page skeletons created */
                viewController.nPrimaryPagesInit = viewController.nPrimaryPagesTotal;
                
                /* tell jQuery Mobile to process new pages (will load topmost=1st primary page by default at start) */
                $.mobile.initializePage();
            }
            
        });
    },
    
    /* create and return skeleton of primary page */
    initPrimaryPage: function(pagenum) {
        
        /* create page skeleton html node */
        var $page = $(viewController.primaryPageSkeletonTmpl)
            .attr('id', pagenum)        
            .attr('data-url', '#' + pagenum);
        
        /* link to previous page (if any) */
        if (pagenum == 1) {
            $page.find('.prev').addClass('ui-disabled');
        } else {
            $page.find('.prev').attr('href', '#' + (pagenum - 1));
        }
        
        /* link to next page (if any) */
        if (pagenum == viewController.nPrimaryPagesTotal) {
            $page.find('.next').addClass('ui-disabled');
        } else {
            $page.find('.next').attr('href', '#' + (pagenum + 1));
        }
        
        /* hide footer until main content inserted */
        $page.find(':jqmData(role=footer)').hide();
        
        /* return newly created page */
        return $page;
        
    },
    
    /* create primary page (insert list of movies for given page) */
    createPrimaryPage: function() {
        
        /* get current page */
        var $page = $(this);
        var pagenum = $(this).attr('id');    
        
        /* while still loading data, show spinner */
        $page.one('pageshow', function() { 
            if ($page.find(':jqmData(role=content)').html().trim() === '') {
                $.mobile.showPageLoadingMsg();
            }
        });
        
        /* get movie data */
        dataSource.getMovies(pagenum).done(function(data) { 
            
            /* render listview template with data */
            $(Mustache.render(viewController.primaryPageContentTmpl, data))                
                /* insert into page in dom */
                .prependTo($page.find(':jqmData(role=content)'))
                /* tell jQuery Mobile to process newly inserted listview widget */
                .listview();        
            
            /* bookkeeping to keep track of # pages created */
            viewController.nPrimaryPagesCreated += 1;
            
            /* page creation completed, can hide spinner & show nav footer */
            $.mobile.hidePageLoadingMsg();
            $page.find(':jqmData(role=footer)').show();
            
        });
    },
    
    /* update secondary page (override content with details for given movie) */
    createSecondaryPage: function() {
        /* get current page */
        var pagenum = $.mobile.activePage.attr('id');
        /* get cached detailed data for selected movie */
        var data = dataSource.getMovie(pagenum, $(this).index());
        $('#secondaryPage')
            /* update header toolbar with movie title */
            .find('#title').html(data.title).end()
            /* render movie details template with data, and insert into DOM as content */
            .find(':jqmData(role=content)').html($(Mustache.render(viewController.secondaryPageContentTmpl, data)));
    }
    
};


/* startup with developer login functionality to obtain Flixster key */
$(document).ready(viewController.preinit);


/* override jQuery Mobile transitioning style defaults */
$(document).bind('mobileinit', function () {
    $.mobile.defaultPageTransition = 'none';
    $.mobile.defaultDialogTransition = 'none';
});
