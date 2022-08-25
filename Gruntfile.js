const sass = require("node-sass");
const pngquant = require('imagemin-pngquant');
const jpegoptim = require('imagemin-jpegoptim');

const pkg = require("./package.json");
const theme = `./public/wp-content/themes/${pkg.name}-theme/`;
const nm = "./node_modules/";

const lib = [
  nm + "jquery/dist/jquery.min.js",
  nm + "js-cookie/dist/js.cookie.min.js",
  nm + "scrollmagic/scrollmagic/minified/ScrollMagic.min.js",
  nm + "scrollmagic/scrollmagic/minified/plugins/animation.gsap.min.js",
  nm + "scrollmagic/scrollmagic/minified/plugins/jquery.ScrollMagic.min.js",
  // nm + "scrollmagic/scrollmagic/minified/plugins/debug.addIndicators.min.js",
  nm + "gsap/dist/gsap.min.js",
  nm + "swiper/swiper-bundle.min.js",
  nm + "ajaxchimp/jquery.ajaxchimp.min.js",
  nm + "ajaxchimp/jquery.ajaxchimp.langs.min.js",
  nm + "lottie-web/build/player/lottie.min.js",
  nm + "lettering.js/index.js",
  nm + "selectric/public/jquery.selectric.min.js",
];

module.exports = function (grunt) {
  grunt.initConfig({
    sass: {
      options: {
        implementation: sass,
      },
      dist: {
        files: [
          {
            src: "src/styles/admin.scss",
            dest: theme + "assets/admin.css",
          },
          {
            src: "src/styles/index.scss",
            dest: theme + "assets/main.css",
          }
        ],
      }
    },
    concat: {
      dist: {
        src: [
          lib,
          "src/scripts/helpers/*.js",
          "src/scripts/index.js",
          "src/scripts/*.js",
          "src/scripts/**/*.js",
          "!src/scripts/*init.js",
          "src/scripts/init.js",
        ],
        dest: theme + "assets/main.js",
      }
    },
    cssmin: {
      target: {
        files: [
          {
            src: theme + "assets/admin.css",
            dest: theme + "assets/admin.css",
          },
          {
            src: theme + "assets/main.css",
            dest: theme + "assets/main.css",
          }
        ]
      }
    },
    postcss: {
      options: {
        map: false,
        processors: [
          require('autoprefixer')(),
        ]
      },
      dist: {
        files: [
          {
            expand: true,
            cwd: theme,
            src: ['**/*.css'],
            dest: theme
          }
        ]
      }
    },
    uglify: {
      build: {
        src: theme + "assets/main.js",
        dest: theme + "assets/main.js",
      }
    },
    imagemin: {
      options: {
        use: [
          jpegoptim({max: 80}),
          pngquant({quality: [0.5, 0.5]}),
        ]
      },
      dynamic: {
        files: [{
          expand: true,
          cwd: theme + "assets/images/",
          src: ["**/*.{png,jpg,jpeg}"],
          dest: theme + "assets/images/",
        }]
      }
    },
    browserSync: {
      bsFiles: {
        src: [
          theme + "*",
          theme + "**/*",
        ],
      },
      options: {
        watchTask: true,
        proxy: `local.${pkg.name}.com`,
      }
    },
    watch: {
      scss: {
        files: ["src/styles/*.scss", "src/styles/**/*.scss"],
        tasks: ["sass:dist", "postcss"],
      },
      scripts: {
        files: ["src/scripts/*.js", "src/scripts/**/*.js"],
        tasks: ["concat:dist"],
      },
    },
  });
  
  grunt.loadNpmTasks("grunt-sass");
  grunt.loadNpmTasks('grunt-postcss');
  grunt.loadNpmTasks("grunt-contrib-concat");
  grunt.loadNpmTasks("grunt-contrib-cssmin");
  grunt.loadNpmTasks("grunt-contrib-watch");
  grunt.loadNpmTasks("grunt-contrib-uglify-es");
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks("grunt-browser-sync");

  grunt.registerTask("dev", ["sass:dist", 'postcss', "concat", "watch", "browserSync"]);
  grunt.registerTask("prod", ["sass:dist", 'postcss', "concat", "cssmin", "uglify", "imagemin"]);

  grunt.registerTask("default", ["prod"]);
  
};
