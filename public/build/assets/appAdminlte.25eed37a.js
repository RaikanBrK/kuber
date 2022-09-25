$(window).on("resize",function(){this.resizeTO&&clearTimeout(this.resizeTO),this.resizeTO=setTimeout(function(){$(this).trigger("resizeEnd")},500)});
