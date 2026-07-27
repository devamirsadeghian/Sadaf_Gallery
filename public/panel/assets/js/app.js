'use strict';

(function ($) {

	var wind_ = $(window),
		body_ = $('body');

	/*------------- create/remove overlay -------------*/
	$.createOverlay = function () {
		if ($('.overlay').length < 1) {
			body_.addClass('no-scroll').append('<div class="overlay"></div>');
			$('.overlay').addClass('show');
		}
	};

	$.removeOverlay = function () {
		body_.removeClass('no-scroll');
		$('.overlay').remove();
	};
	/*------------- create/remove overlay -------------*/

	$('[data-backround-image]').each(function (e) {
		$(this).css("background", 'url(' + $(this).data('backround-image') + ')');
	});

	/*------------- page loader -------------*/
	wind_.on('load', function () {
		$('.page-loader').fadeOut(700, function () {
			setTimeout(function () {
				toastr.options = {
					timeOut: 3000,
					progressBar: true,
					showMethod: "slideDown",
					hideMethod: "slideUp",
					showDuration: 200,
					hideDuration: 200
				};
				toastr.success('خوش آمدید! جان اسنو.');
			}, 1000);
		});

	});
	/*------------- page loader -------------*/

	/*------------- side menu (sub menü arrow) -------------*/
	wind_.on('load', function () {
		setTimeout(function () {
			$('.navigation .navigation-menu-body ul li a').each(function () {
				var $this = $(this);
				if ($this.next('ul').length) {
					$this.append('<i class="sub-menu-arrow ti-plus"></i>');
				}
			});
			$('.navigation .navigation-menu-body ul li.open>a>.sub-menu-arrow').removeClass('ti-plus').addClass('ti-minus').addClass('rotate-in');
		}, 200);
	});

	$(document).on('click', '.navigation .navigation-icons-menu ul li a', function (e) {
		if (!$(this).hasClass('go-to-page')) {
			e.preventDefault();
			$(this).parent().tooltip('hide');
			var target = $(this).attr('href');
			$(this).closest('ul').find('li').removeClass('active');
			$(this).parent('li').addClass('active');
			$('.navigation .navigation-menu-body ul.navigation-active').removeClass('navigation-active');
			$('.navigation .navigation-menu-body ul' + target).addClass('navigation-active');
			return false;
		}
	});
	/*------------- side menu (sub menü arrow) -------------*/

	$.fn.modal.Constructor.prototype.enforceFocus = function () {
		modal_this = this
		$(document).on('focusin.modal', function (e) {
			if (modal_this.$element[0] !== e.target && !modal_this.$element.has(e.target).length
				// add whatever conditions you need here:
				&&
				!$(e.target.parentNode).hasClass('cke_dialog_ui_input_select') && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) {
				modal_this.$element.focus()
			}
		})
	};

	$(document).on('click', '.navbar-toggler', function () {
		$('.header .header-body ul.navbar-nav').toggleClass('open');
		return false;
	});

	$(document).on('click', '.navigation-toggler', function () {
		$('.navigation').toggleClass('open');
		$.createOverlay();
		return false;
	});

	$(document).on('click', '*', function (e) {
		if (!$(e.target).is('.header .header-body ul.navbar-nav, .header .header-body ul.navbar-nav *, .navbar-toggler, .navbar-toggler *')) {
			$('.header .header-body ul.navbar-nav').removeClass('open');
		}
	});

	/*------------- sidebar show/hide -------------*/
	$(document).on('click', '[data-sidebar-open]', function () {
		$('[data-toggle="dropdown"]').dropdown('hide');
		$(this).tooltip('hide');
		var sidebar_id = $(this).data('sidebar-open');
		$('.sidebar').removeClass('show');
		$(sidebar_id).addClass('show');
		$.createOverlay();
		return false;
	});

	$(document).on('click', '.overlay', function () {
		$('.sidebar').removeClass('show');
		$('.navigation').removeClass('open');
		$.removeOverlay();
	});

	/*------------- mobile or hidden side menu open -------------*/
	$(document).on('click', '.side-menu-open', function () {
		$('[data-toggle="dropdown"]').dropdown('hide');
		$('.navigation').addClass('show');
		$.createOverlay();
		return false;
	});
	/*------------- mobile or hidden side menu open -------------*/

	/*------------- form validation -------------*/
	window.addEventListener('load', function () {
		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.getElementsByClassName('needs-validation');
		// Loop over them and prevent submission
		Array.prototype.filter.call(forms, function (form) {
			form.addEventListener('submit', function (event) {
				if (form.checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				}
				form.classList.add('was-validated');
			}, false);
		});
	}, false);
	/*------------- form validation -------------*/

	/*------------- responsive html table -------------*/
	var table_responsive_stack = $(".table-responsive-stack");
	table_responsive_stack
		.find("th")
		.each(function (i) {
			$(".table-responsive-stack td:nth-child(" + (i + 1) + ")").prepend(
				'<span class="table-responsive-stack-thead">' +
				$(this).text() +
				":</span> "
			);
			$(".table-responsive-stack-thead").hide();
		});

	table_responsive_stack.each(function () {
		var thCount = $(this).find("th").length,
			rowGrow = 100 / thCount + "%";
		$(this).find("th, td").css("flex-basis", rowGrow);
	});

	function flexTable() {
		if (wind_.width() < 768) {
			$(".table-responsive-stack").each(function (i) {
				$(this)
					.find(".table-responsive-stack-thead")
					.show();
				$(this)
					.find("thead")
					.hide();
			});

			// window is less than 768px
		} else {
			$(".table-responsive-stack").each(function (i) {
				$(this)
					.find(".table-responsive-stack-thead")
					.hide();
				$(this)
					.find("thead")
					.show();
			});
		}
	}

	flexTable();
	initCustomScrollbar();

	window.onresize = function (event) {
		flexTable();
		initCustomScrollbar('resize');
	};
	/*------------- responsive html table -------------*/

	/*------------- custom accordion -------------*/
	$(document).on('click', '.accordion.custom-accordion .accordion-row a.accordion-header', function () {
		var $this = $(this);
		$this.closest('.accordion.custom-accordion').find('.accordion-row').not($this.parent()).removeClass('open');
		$this.parent('.accordion-row').toggleClass('open');
		return false;
	});
	/*------------- custom accordion -------------*/

	/*------------- responsive table dropdown -------------*/
	var dropdownMenu,
		table_responsive = $('.table-responsive');

	table_responsive.on('show.bs.dropdown', function (e) {
		dropdownMenu = $(e.target).find('.dropdown-menu');
		body_.append(dropdownMenu.detach());
		var eOffset = $(e.target).offset();
		dropdownMenu.css({
			'display': 'block',
			'top': eOffset.top + $(e.target).outerHeight(),
			'left': eOffset.left,
			'width': '184px',
			'font-size': '14px'
		});
		dropdownMenu.addClass("mobPosDropdown");
	});

	table_responsive.on('hide.bs.dropdown', function (e) {
		$(e.target).append(dropdownMenu.detach());
		dropdownMenu.hide();
	});
	/*------------- responsive table dropdown -------------*/

	/*------------- chat -------------*/
	$(document).on('click', '.chat-app-wrapper .btn-chat-sidebar-open', function () {
		$('.chat-app-wrapper .chat-sidebar').addClass('chat-sidebar-opened');
		return false;
	});

	$(document).on('click', '*', function (e) {
		if (!$(e.target).is('.chat-app-wrapper .chat-sidebar, .chat-app-wrapper .chat-sidebar *, .chat-app-wrapper .btn-chat-sidebar-open, .chat-app-wrapper .btn-chat-sidebar-open *')) {
			$('.chat-app-wrapper .chat-sidebar').removeClass('chat-sidebar-opened');
		}
	});
	/*------------- chat -------------*/

	/*------------- aside menu toggle -------------*/
	$(document).on('click', '.navigation ul li a', function () {
		var $this = $(this);
		if ($this.next('ul').length) {
			var sub_menu_arrow = $this.find('.sub-menu-arrow');
			sub_menu_arrow.toggleClass('rotate-in');
			$this.next('ul').toggle(200);
			$this.parent('li').siblings().find('ul').not($this.parent('li').find('ul')).slideUp(200);
			$this.next('ul').find('li ul').slideUp(200);
			$this.next('ul').find('li>a').find('.sub-menu-arrow').removeClass('ti-minus').addClass('ti-plus');
			$this.next('ul').find('li>a').find('.sub-menu-arrow').removeClass('rotate-in');
			$this.parent('li').siblings().not($this.parent('li').find('ul')).find('>a').find('.sub-menu-arrow').removeClass('ti-minus').addClass('ti-plus');
			$this.parent('li').siblings().not($this.parent('li').find('ul')).find('>a').find('.sub-menu-arrow').removeClass('rotate-in');
			if (sub_menu_arrow.hasClass('rotate-in')) {
				setTimeout(function () {
					sub_menu_arrow.removeClass('ti-plus').addClass('ti-minus');
				}, 200);
			} else {
				sub_menu_arrow.removeClass('ti-minus').addClass('ti-plus');
			}
			if (wind_.width() >= 768) {
				setTimeout(function (e) {
					$('.navigation>.navigation-menu-body>ul').getNiceScroll().resize();
				}, 300);
			}
			return false;
		}
	});

	/*------------- other -------------*/
	$(document).on('click', '.dropdown-menu', function (e) {
		e.stopPropagation();
	});

	$('#exampleModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget),
			recipient = button.data('whatever'),
			modal = $(this);

		modal.find('.modal-title').text('پیام جدید به ' + recipient);
		modal.find('.modal-body input').val(recipient);
	});

	$('[data-toggle="tooltip"]').tooltip();

	$('[data-toggle="popover"]').popover();

	$('.carousel').carousel();

	function initCustomScrollbar(type) {

		type = type ? type : '';

		if (type == 'resize') {
			if (wind_.width() >= 768) {
				$('.card-scroll').getNiceScroll().resize();
			}

			if (wind_.width() >= 992) {
				$('.navigation>.navigation-menu-body>ul').getNiceScroll().resize();
			}

			$('.card').each(function () {
				if (wind_.width() >= 768) {
					var $this = $(this),
						scroll_div = $this.find('.card-scroll');
					if (scroll_div.length) {
						scroll_div.getNiceScroll().resize();
					}
				}
			});

			$('.sidebar').each(function () {
				if (wind_.width() >= 768) {
					var $this = $(this);
					$this.getNiceScroll().resize();
				}
			});

			$('.dropdown-menu').each(function () {
				if (typeof $('.dropdown-menu-body', this)[0] != 'undefined' && wind_.width() >= 768) {
					$('.dropdown-menu-body', this).getNiceScroll().resize();
				}
			});

			if (wind_.width() >= 768) {
				$('.chat-app .chat-sidebar .chat-sidebar-messages')[0] ? $('.chat-app .chat-sidebar .chat-sidebar-messages').getNiceScroll().resize() : '';

				$('.chat-app .chat-body .chat-body-messages')[0] ? $('.chat-app .chat-body .chat-body-messages').getNiceScroll().resize() : '';
			}

		} else {
			if (wind_.width() >= 768) {
				$('.card-scroll').niceScroll({railalign: 'left'});
				$('.table-responsive').niceScroll({railalign: 'left'});
			}

			if (wind_.width() >= 992) {
				wind_.on('load', function () {
					$('.navigation>.navigation-menu-body>ul').niceScroll({railalign: 'left'});
				});
			}

			$('.card').each(function () {
				if (wind_.width() >= 768) {
					var $this = $(this),
						scroll_div = $this.find('.card-scroll');
					if (scroll_div.length) {
						scroll_div.niceScroll({railalign: 'left'});
					}
				}
			});

			$('.sidebar').each(function () {
				if (wind_.width() >= 768) {
					var $this = $(this);
					$this.niceScroll({railalign: 'left'});
				}
			});

			$('.dropdown-menu').each(function () {
				if (typeof $('.dropdown-menu-body', this)[0] != 'undefined' && wind_.width() >= 768) {
					$('.dropdown-menu-body', this).niceScroll({railalign: 'left'});
				}
			});

			if (wind_.width() >= 768) {
				$('.chat-app .chat-sidebar .chat-sidebar-messages')[0] ? $('.chat-app .chat-sidebar .chat-sidebar-messages').scrollTop($('.chat-app .chat-sidebar .chat-sidebar-messages').get(0).scrollHeight, -1).niceScroll({railalign: 'left'}) : '';

				$('.chat-app .chat-body .chat-body-messages')[0] ? $('.chat-app .chat-body .chat-body-messages').scrollTop($('.chat-app .chat-body .chat-body-messages').get(0).scrollHeight, -1).niceScroll({railalign: 'left'}) : '';
			}
		}
	}

	if (typeof CKEDITOR == 'object' && $('body').hasClass('dark')) {
		var backgroundColor = $('.card').css("background-color"),
			fontColor = $('body').css("color");
		CKEDITOR.on('instanceReady', function (e) {
			var iframe = $('iframe.cke_wysiwyg_frame');
			iframe.each(function (e) {
				var ifrm = $(this)[0];
				var iframeDocument = ifrm.contentDocument || ifrm.contentWindow.document;
				iframeDocument.body.style.backgroundColor = backgroundColor;
				iframeDocument.body.style.color = fontColor;
			});
		});
	}

	$('.table-email-list .custom-checkbox').click(function (e) {
		e.stopPropagation();
	});

})(jQuery);



//  //////////



const headerDesktopNavbarItems = document.querySelectorAll(
    "#header-desktop-navbar ul",
);
const headerDesktopIndicator = document.querySelector(
    "#header-desktop-navbar-indicator",
);

if (headerDesktopNavbarItems && headerDesktopIndicator) {
    const updateIndicatorStyle = (offsetWidth, offsetLeft, dataset) => {
        const isDarkMode = document.documentElement.classList.contains("dark");
        const backgroundColor = isDarkMode
            ? dataset.colorDark || "#34d399"
            : dataset.colorLight || "#10b981";
        headerDesktopIndicator.style.cssText = `width: ${offsetWidth}px; left: ${offsetLeft}px; background-color: ${backgroundColor};`;
    };

    const indicatorHandlerStart = (e) =>
        updateIndicatorStyle(e.offsetWidth, e.offsetLeft, e.dataset);
    const indicatorHandlerEnd = () => (headerDesktopIndicator.style.width = 0);

    headerDesktopNavbarItems.forEach((item) => {
        item.addEventListener("mouseover", () => indicatorHandlerStart(item));
        item.addEventListener("mouseleave", indicatorHandlerEnd);
    });

    const indicatorHandlerInitial = (e) => {
        const { offsetLeft, dataset } = e;
        updateIndicatorStyle(0, offsetLeft, dataset);
    };

    indicatorHandlerInitial(headerDesktopNavbarItems[0]);
}

// Scroll Top Function Start
const scrollTopFooter = document.getElementById("scroll-top-button-footer");
if (scrollTopFooter)
    scrollTopFooter.addEventListener("click", () =>
        window.scrollTo({ top: 0, behavior: "smooth" }),
    );

// Scroll Top Function End

// Theme Section Start
const theme = {
    current: localStorage.getItem("theme"),
    toggleDesktop: document.getElementById("toggleThemeDesktop"),
    toggleMobile: document.getElementById("toggleThemeMobile"),
    text: document.getElementById("themeText"),
};

if (theme.toggleDesktop || theme.toggleMobile) {
    const setThemeInfo = (mode) => {
        const isDark = mode === "dark";
        if (theme.text) theme.text.innerHTML = `حالت ${isDark ? "شب" : "روز"}`;
    };

    setThemeInfo(theme.current);

    const toggleTheme = () => {
        const isDarkMode = document.documentElement.classList.toggle("dark");
        setThemeInfo(isDarkMode ? "dark" : "light");
        localStorage.setItem("theme", isDarkMode ? "dark" : "light");
    };

    const isDark = () => {
        return document.documentElement.classList.contains("dark");
    };

    const isAppearanceTransition =
        typeof document !== "undefined" &&
        document.startViewTransition &&
        !window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    function toggleDark(event) {
        if (!isAppearanceTransition || !event) {
            toggleTheme();
            return;
        }

        const x = event.clientX;
        const y = event.clientY;
        const endRadius = Math.hypot(
            Math.max(x, innerWidth - x),
            Math.max(y, innerHeight - y),
        );

        const transition = document.startViewTransition(async () => {
            toggleTheme();
        });

        transition.ready.then(() => {
            const clipPath = [
                `circle(0px at ${x}px ${y}px)`,
                `circle(${endRadius}px at ${x}px ${y}px)`,
            ];
            document.documentElement.animate(
                {
                    clipPath: isDark() ? [...clipPath].reverse() : clipPath,
                },
                {
                    duration: 500,
                    easing: "ease-in",
                    pseudoElement: isDark()
                        ? "::view-transition-old(root)"
                        : "::view-transition-new(root)",
                },
            );
        });
    }

    if (theme.toggleDesktop) {
        theme.toggleDesktop.addEventListener("click", toggleDark);
    }

    if (theme.toggleMobile) {
        theme.toggleMobile.addEventListener("click", toggleDark);
    }
}

// Theme Section End

// Header Scripts Section Start

// Toggle Desktop Mega menu ( Categories )
const desktopMegamenuWrapper = document.getElementById(
    "desktopMegamenuWrapper",
);
const desktopMegamenu = document.getElementById("desktopMegamenu");
const headerOverlay = document.getElementById("header-overlay");
let showDesktopMegamenu = false;

if (desktopMegamenuWrapper && desktopMegamenu && headerOverlay) {
    const toggleMegamenu = (event) => {
        showDesktopMegamenu = event.type === "mouseenter";
        desktopMegamenu.classList.toggle("hidden", !showDesktopMegamenu);
        headerOverlay.classList.toggle("hidden", !showDesktopMegamenu);
    };

    desktopMegamenuWrapper.addEventListener("mouseenter", toggleMegamenu);
    desktopMegamenuWrapper.addEventListener("mouseleave", toggleMegamenu);
}

// Hide navbar on Scroll Start
const elementsWithScrollClass = document.querySelectorAll(
    "[data-onscrollclass]",
);

let isScrollingDown = false;
let prevScrollPos = document.documentElement.scrollTop;

const handleScroll = () => {
    const currentScrollPos = document.documentElement.scrollTop;

    if (
        currentScrollPos > prevScrollPos &&
        !showDesktopMegamenu &&
        currentScrollPos > 60
    ) {
        // Scrolling Down
        elementsWithScrollClass.forEach((element) => {
            element.classList.add(element.dataset.onscrollclass);
        });
        isScrollingDown = true;
    } else {
        // Scrolling Up
        elementsWithScrollClass.forEach((element) => {
            element.classList.remove(element.dataset.onscrollclass);
        });
        isScrollingDown = false;
    }

    prevScrollPos = currentScrollPos;
};

window.addEventListener("scroll", handleScroll);

// Hide navbar on Scroll End

// Desktop Header Megamenu section
const categoriesParentsMegamenu = document.querySelectorAll(
    "#mega-menu-parents li",
);
const categoriesChildsMegamenu = document.querySelectorAll(
    "#mega-menu-childs > div",
);

if (categoriesParentsMegamenu.length > 0) {
    const showActiveMegamenu = (index) => {
        categoriesChildsMegamenu.forEach((item) => {
            item.classList.add("hidden");
        });
        categoriesParentsMegamenu.forEach((item) => {
            item.classList.remove("mega-menu-active");
        });
        categoriesParentsMegamenu[index].classList.add("mega-menu-active");

        if (categoriesChildsMegamenu[index])
            categoriesChildsMegamenu[index].classList.remove("hidden");
    };

    categoriesParentsMegamenu.forEach((item, index) => {
        item.addEventListener("mouseenter", () => showActiveMegamenu(index));
    });

    // Active First Category on Website Mount
    showActiveMegamenu(0);
}
// Header Scripts Section End

new Swiper(".banner-slider", {
    pagination: {
        el: ".swiper-pagination",
        dynamicBullets: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    loop: true,
    autoplay: {
        delay: 3000,
    },
});

new Swiper(".product-slider", {
    slidesPerView: 1.5,
    spaceBetween: 14,
    freeMode: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },

    breakpoints: {
        360: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        460: {
            slidesPerView: 2.5,
            spaceBetween: 10,
        },
        640: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 3.5,
            spaceBetween: 10,
        },
        1024: {
            slidesPerView: 4.5,
            spaceBetween: 10,
        },
        1380: {
            slidesPerView: 6,
            spaceBetween: 10,
        },
    },
});
new Swiper(".product-slider-wrapped", {
    slidesPerView: 1.7,
    spaceBetween: 2,
    freeMode: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },

    breakpoints: {
        360: {
            slidesPerView: 2,
            spaceBetween: 2,
        },
        460: {
            slidesPerView: 2.5,
            spaceBetween: 2,
        },
        640: {
            slidesPerView: 3,
            spaceBetween: 2,
        },
        768: {
            slidesPerView: 3.5,
            spaceBetween: 2,
        },
        1024: {
            slidesPerView: 4.5,
            spaceBetween: 2,
        },
        1380: {
            slidesPerView: 6,
            spaceBetween: 2,
        },
    },
});
new Swiper(".product-image-mobile-swiper", {
    pagination: {
        el: ".swiper-pagination",
    },
});
const product_gallery_image_desktop2 = new Swiper(
    ".product-image-desktop-2-swiper",
    {
        slidesPerView: 8,
        spaceBetween: 20,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    },
);
new Swiper(".product-image-desktop-swiper", {
    thumbs: {
        swiper: product_gallery_image_desktop2,
        slideThumbActiveClass: "swiper-thumb-active",
    },
    pagination: {
        el: ".swiper-pagination",
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

new Swiper(".product-comments-swiper", {
    slidesPerView: 1.1,
    spaceBetween: 10,
    freeMode: true,

    breakpoints: {
        360: {
            slidesPerView: 1.2,
            spaceBetween: 10,
        },
        460: {
            slidesPerView: 1.6,
            spaceBetween: 10,
        },
        640: {
            slidesPerView: 2.2,
            spaceBetween: 10,
        },
    },
});
new Swiper(".orders-product-swiper", {
    slidesPerView: 1.1,
    spaceBetween: 10,
    freeMode: true,

    breakpoints: {
        360: {
            slidesPerView: 1.2,
            spaceBetween: 10,
        },
        460: {
            slidesPerView: 1.6,
            spaceBetween: 10,
        },
        640: {
            slidesPerView: 2.2,
            spaceBetween: 10,
        },
        1380: {
            slidesPerView: 3.1,
            spaceBetween: 10,
        },
    },
});
new Swiper(".notifications-product-swiper", {
    slidesPerView: 1.1,
    spaceBetween: 10,
    freeMode: true,

    breakpoints: {
        360: {
            slidesPerView: 1.2,
            spaceBetween: 10,
        },
        460: {
            slidesPerView: 1.6,
            spaceBetween: 10,
        },
        640: {
            slidesPerView: 2.2,
            spaceBetween: 10,
        },
        1380: {
            slidesPerView: 3.1,
            spaceBetween: 10,
        },
    },
});

new Swiper(".blog-slider", {
    slidesPerView: 1.7,
    spaceBetween: 14,
    freeMode: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },

    breakpoints: {
        360: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        460: {
            slidesPerView: 2.5,
            spaceBetween: 15,
        },
        640: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 3.2,
            spaceBetween: 15,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 20,
        },
        1380: {
            slidesPerView: 4,
            spaceBetween: 20,
        },
    },
});
new Swiper(".search-result-desktop", {
    slidesPerView: 1.3,
    spaceBetween: 10,
    freeMode: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },

    breakpoints: {
        360: {
            slidesPerView: 1.5,
            spaceBetween: 10,
        },
        460: {
            slidesPerView: 2.1,
            spaceBetween: 10,
        },
        640: {
            slidesPerView: 2.5,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 2.1,
            spaceBetween: 10,
        },
        1024: {
            slidesPerView: 2.2,
            spaceBetween: 10,
        },
        1380: {
            slidesPerView: 2.5,
            spaceBetween: 10,
        },
    },
});
// Border Animation Section Start
const setMousePosition = (e) => {
    document.querySelectorAll(".border-gradient").forEach((item) => {
        const { left, top } = item.getBoundingClientRect();
        const { clientX, clientY } = e;
        item.style.setProperty("--x", `${clientX - left}px`);
        item.style.setProperty("--y", `${clientY - top}px`);
    });
};

document.addEventListener("mousemove", setMousePosition);

// Border Animation Section End

// noUiSlider Section Start

const shopPriceSlider = document.querySelectorAll("#shop-price-slider");
const shopPriceSliderMin = document.querySelectorAll("#shop-price-slider-min"),
    shopPriceSliderMax = document.querySelectorAll("#shop-price-slider-max");

shopPriceSlider.forEach((item) => {
    noUiSlider.create(item, {
        cssPrefix: "range-slider-",
        start: [0, 100_000_000],
        direction: "rtl",
        margin: 1,
        connect: true,
        range: {
            min: 0,
            max: 100_000_000,
        },
        format: {
            to: function (value) {
                return value.toLocaleString("en-US", {
                    style: "decimal",
                    maximumFractionDigits: 0,
                });
            },
            from: function (value) {
                return parseFloat(value.replace(/,/g, ""));
            },
        },
    });

    item.noUiSlider.on("update", function (values, handle) {
        if (handle) {
            shopPriceSliderMax.forEach((price_item) => {
                price_item.innerHTML = values[handle];
            });
        } else {
            shopPriceSliderMin.forEach((price_item) => {
                price_item.innerHTML = values[handle];
            });
        }
    });
});
// noUiSlider Section End

// Header Search Overlay Start
function initializeSearchComponent(baseId, wrapperId, searchId, resultId) {
    const base = document.getElementById(baseId);
    const wrapper = document.getElementById(wrapperId);
    const search = document.getElementById(searchId);
    const result = document.getElementById(resultId);

    if (!base || !wrapper || !search || !result) {
        return;
    }

    function hideSearchResults() {
        wrapper.classList.remove("border", "bg-muted", "rounded-b-none");
        wrapper.classList.add("bg-background");
        search.classList.remove("bg-muted");
        search.classList.add("bg-background");
        wrapper.classList.remove("rounded-b-none");
        headerOverlay.classList.add("hidden");
        result.classList.add("hidden");
        isSearchResultShow = false;
    }

    search.addEventListener("focus", () => {
        wrapper.classList.add("border", "bg-muted", "rounded-b-none");
        wrapper.classList.remove("bg-background");
        search.classList.add("bg-muted");
        search.classList.remove("bg-background");
        headerOverlay.classList.remove("hidden");
        result.classList.remove("hidden");
        isSearchResultShow = true;
    });

    return { base, hideSearchResults };
}

const desktopSearchComponent = initializeSearchComponent(
    "desktopHeaderSearchBase",
    "desktopHeaderSearchWrapper",
    "desktopHeaderSearch",
    "desktopHeaderSearchResult",
);

const mobileSearchComponent = initializeSearchComponent(
    "mobileHeaderSearchBase",
    "mobileHeaderSearchWrapper",
    "mobileHeaderSearch",
    "mobileHeaderSearchResult",
);

if (desktopSearchComponent || mobileSearchComponent) {
    const { base: desktopBase, hideSearchResults: hideDesktopSearchResults } =
    desktopSearchComponent || {};
    const { base: mobileBase, hideSearchResults: hideMobileSearchResults } =
    mobileSearchComponent || {};

    // Add click event listener to the document
    document.addEventListener("mousedown", (event) => {
        if (
            (!desktopBase || !desktopBase.contains(event.target)) &&
            (!mobileBase || !mobileBase.contains(event.target))
        ) {
            if (hideDesktopSearchResults) {
                hideDesktopSearchResults();
            }
            if (hideMobileSearchResults) {
                hideMobileSearchResults();
            }
        }
    });
}

// Header Search Overlay End

// Quiantity Input Start
function quantityDecrement(e) {
    const btn = e.target.parentNode.parentElement.querySelector(
        'button[data-action="increment"]',
    );
    if (btn) {
        const target = btn.nextElementSibling;
        if (target) {
            let value = Number(target.value);
            const min = target.hasAttribute("min") ? Number(target.min) : -Infinity;
            const max = target.hasAttribute("max") ? Number(target.max) : Infinity;
            if (value == 1) return;
            // Check if value is greater than the minimum allowed value
            if (isNaN(min) || value > min) {
                value--;
            }

            // Update only if value is less than or equal to the maximum allowed value
            if (isNaN(max) || value <= max) {
                target.value = value;
            }
        }
    }
}

function quantityIncrement(e) {
    const btn = e.target.parentNode.parentElement.querySelector(
        'button[data-action="increment"]',
    );
    if (btn) {
        const target = btn.nextElementSibling;
        if (target) {
            let value = Number(target.value);
            const min = target.hasAttribute("min") ? Number(target.min) : -Infinity;
            const max = target.hasAttribute("max") ? Number(target.max) : Infinity;

            // Check if value is less than the maximum allowed value
            if (isNaN(max) || value < max) {
                value++;
            }

            // Update only if value is greater than or equal to the minimum allowed value
            if (isNaN(min) || value >= min) {
                target.value = value;
            }
        }
    }
}

const quantityDecrementButtons = document.querySelectorAll(
    `button[data-action="decrement"]`,
);

const quantityIncrementButtons = document.querySelectorAll(
    `button[data-action="increment"]`,
);

quantityDecrementButtons.forEach((btn) => {
    btn.addEventListener("click", quantityDecrement);
});

quantityIncrementButtons.forEach((btn) => {
    btn.addEventListener("click", quantityIncrement);
});
// Quiantity Input End

// Accordion
const accordionItems = document.querySelectorAll("[data-accordion-item]");

accordionItems.forEach((item) => {
    const button = item.querySelector("[data-accordion-button]");
    const content = item.querySelector("[data-accordion-content]");
    const chevron = item.querySelector("[data-accordion-chevron]");

    button.addEventListener("click", (event) => {
        // Prevent triggering parent accordions
        event.stopPropagation();

        const isOpen = item.classList.contains("open");

        // Close sibling accordions only at the same level
        const siblingItems = Array.from(item.parentElement.children).filter(
            (sibling) => sibling !== item && sibling.classList.contains("open"),
        );

        siblingItems.forEach((sibling) => {
            sibling.classList.remove("open");
            const siblingContent = sibling.querySelector("[data-accordion-content]");
            siblingContent.style.maxHeight = null;
            const siblingChevron = sibling.querySelector("[data-accordion-chevron]");
            siblingChevron.classList.remove("-rotate-90");
        });

        if (isOpen) {
            // If the current accordion is open, close it
            item.classList.remove("open");
            content.style.maxHeight = null;
            chevron.classList.remove("-rotate-90");
        } else {
            // If the current accordion is closed, open it
            item.classList.add("open");

            // Calculate and set max-height based on the content and any open child accordion
            const totalHeight = calculateTotalHeight(content);
            content.style.maxHeight = totalHeight + "px";

            chevron.classList.add("-rotate-90");
        }
    });

    content.addEventListener("transitionend", () => {
        if (!item.classList.contains("open")) {
            content.style.maxHeight = null;
        }
    });
});

// Helper function to calculate total height of the content, including any open nested accordions
function calculateTotalHeight(content) {
    let totalHeight = content.scrollHeight; // Start with the current content height

    // Check for any open nested accordion items
    const openNestedItems = content.querySelectorAll(
        "[data-accordion-item].open [data-accordion-content]",
    );

    openNestedItems.forEach((nestedContent) => {
        totalHeight += nestedContent.scrollHeight; // Add the height of the open nested content
    });

    return totalHeight;
}
