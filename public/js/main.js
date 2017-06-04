/**
 * Created by mayst on 22.02.2017.
 */


/*style of browse button on home and add video pages*/
if (window.location.pathname == '/home' || window.location.pathname == '/add-video') {
    let inputFile = document.getElementById('inputFile');
    let inputFileLabel = document.getElementById('inputFileLabel');
    inputFile.addEventListener('change', changeColor);
    function changeColor() {
        if (inputFile.value) {
            inputFileLabel.style.background = 'rgb(84, 170, 84)';
            inputFileLabel.innerHTML = inputFile.value.replace("C:\\fakepath\\", '');
            inputFileLabel.style.color = 'white';
        }
        else {
            inputFileLabel.innerHTML = 'Please select file!';
        }
    }
}


$(document).ready(function () {

    /*owl carousel options*/
    $(".home-carousel").owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        nav: true,
        dots: true,
        dragable:false,
        responsive: {
            0: {
                touchDrag: true,
                items: 1
            },
            600: {
                items: 3,
                center: true,
                autoplay: true,
                autoplayHoverPause: true
            }
        }
    });

    /* rating stars on comment*/
    let $bottomRating = $('#input-1-ltr-alt-xs');
    $bottomRating.rating({
        showCaption: false,
        hoverOnClear: false,
        step: 0.5,
        theme: 'krajee-fa',
        defaultCaption: '{rating} hearts',
        starCaptions: function (rating) {
            return rating == 1 ? 'One heart' : rating + ' hearts';
        },
        filledStar: '<i class="fa fa-heart"></i>',
        emptyStar: '<i class="fa fa-heart-o"></i>'
    });
    $bottomRating.on('rating.change', function (event, value, caption) {
        let $input = $("input[name='rating']");
        $input.val(value);
    });


    /*video avg rating*/
    $('#videoRate').rating({
        showClear: false,
        theme: 'krajee-fa',
        disabled: false,
        readonly: true,
        defaultCaption: '{rating} hearts',
        starCaptions: function (rating) {
            return rating == 1 ? 'One heart' : rating + ' hearts';
        },
        step: 0.1,
        filledStar: '<i class="fa fa-heart"></i>',
        emptyStar: '<i class="fa fa-heart-o"></i>'
    });

    /*welcome video rating*/
    $('.welcome_video_rating').rating({
        showClear: false,
        showCaption: false,
        theme: 'krajee-fa',
        disabled: false,
        readonly: true,
        size: 'xxs',
        defaultCaption: '{rating} hearts',
        starCaptions: function (rating) {
            return rating == 1 ? 'One heart' : rating + ' hearts';
        },
        step: 0.1,
        filledStar: '<i class="fa fa-heart"></i>',
        emptyStar: '<i class="fa fa-heart-o"></i>'
    });

    /*All users page*/

    /*infinite page*/
    if (window.location.pathname.indexOf('videos') < 0) {
        $('ul.pagination').hide();
        $(function () {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<img class="center-block" src="/img/loading.gif" alt="Loading..." />',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function () {
                    $('ul.pagination').remove();
                }
            });
        });
        /*ratings when adding videos on page*/
        $('.infinite-scroll').bind('DOMSubtreeModified', function () {
            setTimeout(function () {
                $('.welcome_video_rating').rating({
                    showClear: false,
                    showCaption: false,
                    theme: 'krajee-fa',
                    disabled: false,
                    readonly: true,
                    size: 'xxs',
                    defaultCaption: '{rating} hearts',
                    starCaptions: function (rating) {
                        return rating == 1 ? 'One heart' : rating + ' hearts';
                    },
                    step: 0.1,
                    filledStar: '<i class="fa fa-heart"></i>',
                    emptyStar: '<i class="fa fa-heart-o"></i>'
                });
            }, 1);
        });
    }
    /*comments ajax*/
    $('body').on('click', '.pagination a', function (e) {
        e.preventDefault();
        $('#load a').css('color', '#dfecf6');
        $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');
        let url = $(this).attr('href');
        getComments(url);
        window.history.pushState("", "", url);
    });
    function getComments(url) {
        $.ajax({
            url: url
        }).done(function (data) {
            $('.comments').html(data);
        }).fail(function () {
            alert('Comments could not be loaded.');
        });
    }

    /*delete video ajax*/
    $('.delete_button').on('click', function (e) {
        e.preventDefault();
        let curVideo = $(this);
        let data = curVideo.attr('href');
        let parentVideo = curVideo.parent().parent();
        deleteVideo();

        function deleteVideo() {
            $.ajax({
                type: 'get',
                url: 'deleteVideo',
                data: {
                    id: data
                },
            }).done(function () {
                parentVideo.hide();

            })
        }
    });

    /*return video*/
    $('.return_button').on('click', function (e) {
        e.preventDefault();
        let curVideo = $(this);
        let data = curVideo.attr('href');
        let parentVideo = curVideo.parent().parent();
        returnVideo();

        function returnVideo() {
            $.ajax({
                type:'get',
                url: 'returnVideo',
                data:{
                    id: data
                },
            }).done(function () {
                parentVideo.hide();
            })
        }
    });

    /*home trash visibility*/
    $('.trash_p').on('click', function () {
        $('.trash_carousel_cont_home').slideToggle('slow');
    })
});
