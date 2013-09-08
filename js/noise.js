(function (a) {
  a.fn.noisy = function (b) {
    b = a.extend({}, a.fn.noisy.defaults, b);
    var f, c = document.createElement("canvas");
    if (c.getContext) {
      c.width = c.height = b.size;
      for (var h = c.getContext("2d"), d = h.createImageData(c.width, c.height), i = b.intensity * Math.pow(b.size, 2), j = 255 * b.opacity; i--;) {
        var e = (~~ (Math.random() * c.width) + ~~ (Math.random() * c.height) * d.width) * 4,
          g = i % 255;
        d.data[e] = g;
        d.data[e + 1] = b.monochrome ? g : ~~ (Math.random() * 255);
        d.data[e + 2] = b.monochrome ? g : ~~ (Math.random() * 255);
        d.data[e + 3] = ~~ (Math.random() * j)
      }
      h.putImageData(d, 0, 0);
      f = c.toDataURL("image/png")
    }
    else f = b.fallback;
    return this.each(function () {
      a(this).data("original-css") == undefined && a(this).data("original-css", a(this).css("background-image"));
      a(this).css("background-image", "url(" + f + ")," + a(this).data("original-css"))
    })
  };
  a.fn.noisy.defaults = {
    intensity: 0.9,
    size: 200,
    opacity: 0.08,
    fallback: "",
    bg: "#ff0000",
    monochrome: true
  }
})(jQuery);