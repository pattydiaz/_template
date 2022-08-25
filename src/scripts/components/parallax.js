var Parallax = {
  init: function() {
    Parallax.animate();
  },
  animate: function() {
    $('.parallax').each(function() {
      var $this = $(this);
      var height = '200%';
      var $data = $this.data('parallax');
      var $item;

      if($this.hasClass('parallax-item'))
        $item = $this;
      else
        $item = $this.find('.parallax-item');

      var parallaxTween = gsap.fromTo($item, {y: -$data+'%'}, {y: $data+'%', duration: 1, ease: 'sine.inOut'});

      var parallaxScene = new ScrollMagic.Scene({
        triggerElement: $this[0],
        duration: height
      });

      // parallaxScene.addIndicators();
      parallaxScene.triggerHook(1);
      parallaxScene.setTween(parallaxTween);
      parallaxScene.addTo(controller);

      
      w.on('resize',function(){
        height = "200%";

        parallaxScene.duration(height);
        parallaxScene.triggerElement($this[0]);
        parallaxScene.refresh();
      });
    });
  }
}