document.addEventListener("DOMContentLoaded", function (event) {
    const locomotiveScroll = new LocomotiveScroll({
        lenisOptions: {
            wrapper: window,
            content: document.documentElement,
            lerp: 0.1,
            duration: 1.2,
            orientation: 'vertical',
            gestureOrientation: 'vertical',
            smoothWheel: true,
            smoothTouch: true,
            wheelMultiplier: 1,
            touchMultiplier: 2,
            normalizeWheel: true,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        },
    });

    gsap.utils.toArray('[animate-fadein]').forEach(item => {
        gsap.from(item, {
          opacity: 0,
          y: 50,
          duration: 1,
          ease: "power1.out",
          scrollTrigger: {
            trigger: item,
            start: "top bottom",
            end: "center center",
            scrub: true,
            markers: false
          }
        });
    });
})