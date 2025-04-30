let appendNumber = 600;
    let prependNumber = 1;
    const swiper = new Swiper('.swiper', {
      slidesPerView: 3,
      centeredSlides: true,
      spaceBetween: 30,
      pagination: {
        el: '.swiper-pagination',
        type: 'fraction',
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      virtual: {
        slides: (function () {
          const slides = [];
          for (var i = 0; i < 600; i += 1) {
            slides.push('Slide ' + (i + 1));
          }
          return slides;
        })(),
      },
    });

    document
      .querySelector('.slide-1')
      .addEventListener('click', function (e) {
        e.preventDefault();
        swiper.slideTo(0, 0);
      });

    document
      .querySelector('.slide-250')
      .addEventListener('click', function (e) {
        e.preventDefault();
        swiper.slideTo(249, 0);
      });

    document
      .querySelector('.slide-500')
      .addEventListener('click', function (e) {
        e.preventDefault();
        swiper.slideTo(499, 0);
      });

    document
      .querySelector('.prepend-2-slides')
      .addEventListener('click', function (e) {
        e.preventDefault();
        swiper.virtual.prependSlide([
          '<img src="image/profil-amis.jpg" alt="">' + --prependNumber,
          '<img src="image/profil-amis.jpg" alt="">' + --prependNumber,
        ]);
      });

    document
      .querySelector('.append-slide')
      .addEventListener('click', function (e) {
        e.preventDefault();
        swiper.virtual.appendSlide('<img src="image/profil-amis.jpg" alt="">' + ++appendNumber);
      });