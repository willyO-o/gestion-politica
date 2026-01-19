; (function ($) {

    var opts = {};
    var defaults = {
        'url': null, // The url you are fetching the results.
        'autoload': true, // Change this to false if you want to load manually, default true.
        'data': {
            'page': 1, // Which page at the first time
            'size': 10, // Number of pages
        },
        'before': function () {
            // Before load function, you can display a preloader div
            // $(this.loading).fadeIn();
            $(this.loading).css('min-height', '50px').fadeIn();
        },
        'after': function (elementsLoaded) {
            // After loading content, you can use this function to animate your new elements
            if (elementsLoaded.length > 0) {
                $(this.loading).fadeOut();
                $(elementsLoaded).fadeInWithDelay();
            }
        },
        'scroller': $(window), // Who gonna scroll? default is the full window
        'heightOffset': 20, // It gonna request when scroll is 10 pixels before the page ends
        'loading': '#loading', // ID of loading prompt.
        'loadingText': 'Cargando...', // Text of loading prompt.
        'loadingNomoreText': 'Sin Resultados.', // No more of loading prompt.
        'manuallyText': 'click para cargar Manual.',
        'elementCountTemplate': 'Listando {count} elementos de {total} encontrados', // Nuevo template para contador de elementos
        'elementCountSelector': null, // Selector donde se inyectará el mensaje de listado
        'dataTemplateCallback': function (data) {
            var html = "<li style='opacity:0;-moz-opacity: 0;filter: alpha(opacity=0);'><p>" + data + "</p></li>";
            return html;
        },
    };

    // Función para actualizar el mensaje del contador de elementos
    var updateElementCountMessage = function (opts, data) {
        if (opts.elementCountSelector && $(opts.elementCountSelector).length) {
            if (data.total > 0) {
                var count = opts.data.page * opts.data.size > data.total ? data.total : opts.data.page * opts.data.size;
                var message = opts.elementCountTemplate.replace('{count}', count)
                    .replace('{total}', data.total);
                $(opts.elementCountSelector).html(message).show(); // Muestra el contenedor con el mensaje
            } else {
                $(opts.elementCountSelector).hide(); // Oculta el contenedor si no hay datos
            }
        }
    };

    // Función para resetear el contador de elementos
    var resetElementCountMessage = function (opts) {
        if (opts.elementCountSelector && $(opts.elementCountSelector).length) {
            $(opts.elementCountSelector).hide(); // Oculta el contenedor al resetear
        }
    };

    // Renombrar función de inicialización y reset
    $.fn.customScrollPagination = function (options) {
        opts = $.extend(defaults, options);
        var target = opts.scroller;
        opts.target = this;
        return this.each(function () {
            $.fn.customScrollPagination.init($(this), opts);
        });
    };


    $.fn.resetCustomScrollPagination = function (newData) {
        opts.data = newData;
        opts.data.page = 1;
        $(this).data('scrollPagination', opts);
        $(this).html('');
        $(this).attr('scrollPagination', 'enabled');
        resetElementCountMessage(opts); // Resetea el contador de elementos
        $.fn.customScrollPagination.loadContent(this, opts);
    };

    $.fn.customScrollPagination.init = function (obj, opts) {
        var target = opts.scroller;
        $(obj).attr('scrollPagination', 'enabled');
        if ($(obj).children().length === 0) {
            $.fn.customScrollPagination.loadContent(obj, opts);
        }
        if (opts.autoload === true) {
            $(target).scroll(function (event) {
                if ($(obj).attr('scrollPagination') == 'enabled') {
                    var mayLoadContent = (Math.ceil($(target).scrollTop()) + opts.heightOffset) >= ($(document).height() - $(target).height());
                    if (mayLoadContent) {
                        $.fn.customScrollPagination.loadContent(obj, opts);
                    }
                } else {
                    event.stopPropagation(obj, opts);
                }
            });
        } else {
            opts.loadingText = opts.manuallyText;
            $(opts.loading).html(opts.loadingText).fadeIn().on('click', function (event) {
                if ($(obj).attr('scrollPagination') == 'enabled') {
                    $.fn.customScrollPagination.loadContent(obj, opts);
                } else {
                    event.stopPropagation(obj, opts);
                }
            });
        }
    };

    $.fn.stopScrollPagination = function (obj = null, opts = null) {
        if (obj == null) {
            return this.each(function () {
                $(this).attr('scrollPagination', 'disabled');
            });
        } else {
            $(opts.loading).html(opts.loadingNomoreText).fadeIn();
            $(obj).attr('scrollPagination', 'disabled');
        }
    };

    $.fn.customScrollPagination.loadContent = function (obj, opts) {
        var target = opts.scroller;
        $(opts.loading).html(opts.loadingText);
        if (opts.before != null) {
            opts.before();
        }
        $(obj).children().attr('rel', 'loaded');
        var ajaxRequest = {
            type: opts.method === 'post' ? 'post' : 'get',
            url: opts.url,
            data: opts.data,
        };
        if ($(obj).data('requestRunning')) {
            return;
        }
        $(obj).data('requestRunning', true)
        $.ajax(ajaxRequest)
            .done(function (data) {
                var html = "";
                if (data != null && data.datos.length > 0) {
                    $.each(data.datos, function (index, value) {
                        html += opts.dataTemplateCallback(value);
                    });
                    $(obj).append(html);
                    updateElementCountMessage(opts, data); // Llamada a la función para actualizar el mensaje del contador
                    if (data.datos.length < opts.data.size) {
                        $.fn.stopScrollPagination(obj, opts);
                    } else {
                        opts.data.page++;
                    }
                } else {
                    $.fn.stopScrollPagination(obj, opts);
                }
                var objectsRendered = $(obj).children('[rel!=loaded]');
                if (opts.after != null) {
                    opts.after(objectsRendered);
                }
                $(obj).data('requestRunning', false)
            })
            .fail(function () {
                $(obj).data('requestRunning', false)
                console.error('Error fetching data.');
            });
    };

    $.fn.fadeInWithDelay = function () {
        var delay = 0;
        return this.each(function () {
            $(this).delay(delay).animate({ opacity: 1 }, 300);
            delay += 100;
        });
    };
})(jQuery);
