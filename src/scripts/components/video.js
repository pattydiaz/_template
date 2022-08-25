var video = $('.video-cover');

var Video = {
  init: function () {
    Video.build();
  },
  build: function () {
    if(video.is(':visible')) Video.fit();
  },
  fit: function () {
    video.each(function() {
      var vid = $(this);
      var vid_id = vid.data('video-id');
      var min_w = 0; // minimum video width allowed
      var vid_w_orig; // original video dimensions
      var vid_h_orig;

      jQuery(function () {
        // runs after DOM has loaded
        var iframe = $(this).find('iframe[id="'+vid_id+'"]');
  
        vid_w_orig = parseInt(iframe.attr("width"));
        vid_h_orig = parseInt(iframe.attr("height"));
  
        Video.resize(vid, vid_w_orig, vid_h_orig, min_w, iframe);
        
        w.on('resize', function () {
          Video.resize(vid, vid_w_orig, vid_h_orig, min_w, iframe);
        });
        
        // w.trigger("resize");
      });
    });
  },
  resize:function(el, w, h, min, emb) {

    if(el.parents('.video-cover-parent').length) {
      
      var ew = el.parents('.video-cover-parent').width();
      var eh = el.parents('.video-cover-parent').height();

    } else {
      var ew = el.parent().width();
      var eh = el.parent().height();

      ew = Math.round(ew + 2);
      eh = Math.round(eh + 2);
    }

    if(el.hasClass('parallax-item')) {
      var ph = el.parent().parent().data('parallax');
      eh = eh + (ph*5)
    }

    // set the video viewport to the [parent] size
    el.width(ew);
    el.height(eh);

    // use largest scale factor of horizontal/vertical
    var scale_h = ew / w;
    var scale_v = eh / h;
    var scale   = Math.max(scale_h, scale_v);


    // don't allow scaled width < minimum video width
    if (scale * w < min) {
      scale = min / w;
    }

    emb
      .width(scale * w)
      .height(scale * h)
      .css({
          position: 'absolute',
          top: '50%',
          left: '50%',
          transform: 'translateX(-50%) translateY(-50%)',
      });
  }
};