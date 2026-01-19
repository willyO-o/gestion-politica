$(function () {
    "use strict";

    let listaImagenes = [];

    $.get('/rt/json/images-list.json')
        .done(function (data) {
            console.log(data);
            listaImagenes = data;

            generarCards();

        })


    function generarCards(indice = 0) {

        let html = '';
        let fin = indice + 9;
        for (let i = indice; i < fin; i++) {
            if (listaImagenes[i]) {
                html += /* html */ `
                <div class="col-xs-8 col-sm-6 col-lg-4 img-gallery-item">
                    <article class="thumbnail-classic"><a class="thumbnail-classic-figure"
                            href="rt/gallery/${listaImagenes[i]}" data-lightgallery="item"><img
                                src="rt/gallery/${listaImagenes[i]}" alt="" width="370" height="340"></a>
                        <div class="thumbnail-classic-caption">
                            <div class="thumbnail-classic-panel-right"><span
                                    class="thumbnail-classic-panel-toggle mdi mdi-share-variant"></span>
                                <ul class="thumbnail-classic-list list-inline list-inline-xs">
                                    <li><a class="fa fa-facebook" href="#"></a></li>
                                    <li><a class="fa fa-twitter" href="#"></a></li>
                                    <li><a class="fa fa-instagram" href="#"></a></li>
                                    <li><a class="fa fa-pinterest-p" href="#"></a></li>
                                </ul>
                            </div>
                            <div class="thumbnail-classic-panel-left">
                                <h6 class="thumbnail-classic-title">Foto #${i + 1}</h6><span
                                    class="thumbnail-classic-subtitle">Compartir</span>
                            </div>
                        </div>
                    </article>
                </div>`;

            }


        }

        $('#galeria').append(html);
        iniciarLightGallery();

    }




    function iniciarLightGallery() {

        $(`[data-lightgallery="item"]`).lightGallery({
            selector: "this",
            // addClass:            addClass,
            counter: false,
            youtubePlayerParams: {
                modestbranding: 1,
                showinfo: 0,
                rel: 0,
                controls: 0
            },
            vimeoPlayerParams: {
                byline: 0,
                portrait: 0
            }
        });
    }


    $("#loadImg").click(function (e) {
        e.preventDefault();

        let cantidad = $('.img-gallery-item').length;

        if (cantidad >= listaImagenes.length) {
            $('#loadImg').hide();
            return;
        }


        generarCards(cantidad);


    })


})
