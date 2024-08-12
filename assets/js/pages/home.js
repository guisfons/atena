document.addEventListener("DOMContentLoaded", function (event) {
    window.addEventListener("load", function (e) {
        gsap.registerPlugin(ScrollTrigger)
        gsap.to('.sustentabilidade__texto-highlight', {
            scrollTrigger: {
                trigger: ".sustentabilidade__map",
                start: "top bottom",
                end: "center center",
                scrub: true
            },
            clipPath: "inset(0 0% 0 0)"
        })
    })

    gsap.fromTo(".sustentabilidade__map-effect",{
            filter: "grayscale(100%)"
        },
        {
            filter: "grayscale(0%)",
            scrollTrigger: {
                trigger: ".sustentabilidade__map",
                start: "top bottom",
                end: "center center",
                scrub: true
            },
            duration: 1,
            ease: "power1.inOut"
        }
    );
})