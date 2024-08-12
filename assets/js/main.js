window.addEventListener('DOMContentLoaded', function(){
    header()
    
    if(document.querySelector('.banner--home')) {
        banner()
    }

    if(document.querySelector('select')) {
        $('select').niceSelect();

        midia()
    }

    if(document.querySelector('.slider__images')) {
        sliders($('.slider__images'))
    }

    if(document.querySelector('.cases__slider')) {
        cases($('.cases__slider'))
    }

    if(document.querySelector('.comunidades__slider')) {
        comunidades($('.comunidades__slider'))
    }

    if(document.querySelector('.galeria__slider')) {
        galeria($('.galeria__slider'), $('.galeria__modal-slider'))
    }
})

function header() {
    let header = document.querySelector('.header')
    if(screen.width > 900) {
        document.addEventListener('scroll', function() {
            let headerMenu = document.querySelector('.header__menu')
        
            if (window.scrollY > header.offsetHeight + 100) {
                headerMenu.classList.add('header__menu--fixed')
            } else {
                headerMenu.classList.remove('header__menu--fixed')
            }
        })
    }

    if(screen.width < 901) {
        document.querySelector('.header__language').addEventListener('click', function() {
            this.querySelector('.header__language-container').classList.toggle('header__language-container--active')
        })
    }

    document.querySelector('.header__mobile').addEventListener('click', function() {
        this.classList.toggle('header__mobile--active')

        document.querySelector('.header__menu').classList.toggle('header__menu--active')
    })
}

function banner() {
    bannerTitle()

    const figures = document.querySelectorAll('.banner--home figure')
    const imageSources = []

    figures.forEach(figure => {
        const img = figure.querySelector('img')
        if (img && img.dataset.src) {
            imageSources.push(img.dataset.src)
        }
    })
    
    function shuffle(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
    }

    shuffle(imageSources)

    const totalDuration = 5000
    const minDelay = 0
    const maxDelay = totalDuration - 1000

    figures.forEach((figure, index) => {
        const img = figure.querySelector('img')
        if (img) {
            img.src = imageSources[index]
            img.onload = () => {
               
                const randomDelay = Math.random() * (maxDelay - minDelay) + minDelay
                setTimeout(() => {
                    img.style.opacity = 1
                }, randomDelay)
            }
        }
    })
}

function bannerTitle() {
    const spans = document.querySelectorAll('.banner__text span')
    let currentSpan = 0
    const typingSpeed = 300
    const delayBetweenSpans = 6000
    
    function typeWriter(span, text, index) {
        if (index < text.length) {
            span.textContent += text.charAt(index)
            setTimeout(() => {
                typeWriter(span, text, index + 1)
            }, typingSpeed)
        } else {
            span.classList.remove('typing')
            setTimeout(() => {
                spans[currentSpan].classList.remove('active')
                currentSpan = (currentSpan + 1) % spans.length
                spans[currentSpan].classList.add('active', 'typing')
                const initialText = spans[currentSpan].textContent
                spans[currentSpan].textContent = ''
                typeWriter(spans[currentSpan], initialText, 0)
            }, delayBetweenSpans)
        }
    }
    
    spans[currentSpan].classList.add('active', 'typing')
    const initialText = spans[currentSpan].textContent
    spans[currentSpan].textContent = ''
    typeWriter(spans[currentSpan], initialText, 0)
}

function midia() {
    $('select').on('change.nice_select', function() {
        $('.midia__sort').find('button').click()
    });

    load_more_posts()
}

function load_more_posts() {
    var page = 1;
    var perPage = 9;
    var nonce = myAjaxObject.nonce;
    var ajaxUrl = myAjaxObject.ajax_url;

    function loadMorePosts() {
        $.ajax({
            url: ajaxUrl,
            method: 'POST',
            data: {
                action: 'load_more_posts',
                page: page + 1,
                per_page: perPage,
                nonce: nonce
            },
            success: function(response) {
                if (response.has_more) {
                    $('.midia__posts').append(response.posts);
                    page++;
                } else {
                    $('.midia__carregar').hide();
                }
            },
            error: function() {
                alert('Error loading posts');
            }
        });
    }

    $('.midia__carregar').click(function() {
        loadMorePosts();
    });
}

function sliders(element) {
    element.slick({
        slidesToShow: 5,
        responsive: [
            {
              breakpoint: 900,
              settings: {
                slidesToShow: 3,
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 2,
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
              }
            }
        ]
    })
}

function cases(element) {
    element.slick({
        infinite: false,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        adaptiveHeight: true,
        nextArrow: '.cases__arrow--next',
        prevArrow: '.cases__arrow--prev'
    })
}

function comunidades(element) {
    element.slick({
        slidesToShow: 3,
        slidesToSroll: 1,
        infinite: false,
        nextArrow: '.comunidades__arrow--next',
        prevArrow: '.comunidades__arrow--prev',
        responsive: [
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
              }
            },
            {
                breakpoint: 600,
                settings: {
                  slidesToShow: 1,
                }
            }
        ]
    })
}

function galeria(element, modal) {
    var viewportWidth = $(window).width();
    if( viewportWidth > 767 ){
        var rows = 3;
        var slides = 3;
    } else if( viewportWidth < 768 ){
        var rows = 1;
        var slides = 2;
    }

    element.slick({
        rows: rows,
        slidesPerRow: slides,
        slidesToShow: 1,
        slidesToSroll: 1,
        infinite: false,
        nextArrow: '.galeria__arrow--next',
        prevArrow: '.galeria__arrow--prev',
    })

    modal.slick({
        slidesToShow: 1,
        infinite: false,
    })

    element.find('.galeria__slide').on('click', function() {
        let id = $(this).data('slide')
        modal.slick('slickGoTo', id);

        $('.galeria__modal').addClass('galeria__modal--active')

        $('.galeria__modal-close').on('click', function() {
            $(this).closest('.galeria__modal').removeClass('galeria__modal--active')
        })
    })
}