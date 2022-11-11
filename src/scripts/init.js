var Project = {
  init: function() {
    Loader.init();
    // Agegate.init();
    Header.init();
    Navigation.init();

    Buttons.init();
    Inputs.init();
    Video.init();
    Parallax.init();
    Slider.init();
    Filter.init();
    Newsletter.init();
  }
};

Page.init();

$(function(){
  Project.init();
});