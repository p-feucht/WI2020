
  $('.carousel').slick({
    infinite: true,
    accessibility:true,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 3000,
    dots: false,
    centerMode: true,
    centerPadding: '0',
    pauseOnHover: true,
    //prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
    //nextArrow: "<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
    mobileFirst: true,
    reponsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          infinite: true
        }
      }, {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          dots: true,
          arrows: false
        }
      }, {
        breakpoint: 300,
        settings: "unslick"
      }]
  });


