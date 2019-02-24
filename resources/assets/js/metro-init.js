(function($) {
  $.StartScreen = function(){
    const plugin = this
    const width = (window.innerWidth > 0) ? window.innerWidth : screen.width
    plugin.init = function(){
    }
    plugin.init()
  }
})(jQuery)

window.metro_init = function(){
  $.StartScreen()
  const tiles = $(".tile, .tile-small, .tile-sqaure, .tile-wide, .tile-large, .tile-big, .tile-super")
  $.each(tiles, function(){
    const tile = $(this)
    setTimeout(function(){
      tile.css({
        opacity: 1,
        "-webkit-transform": "scale(1)",
        "transform": "scale(1)",
        "-webkit-transition": ".3s",
        "transition": ".3s"
      })
    }, Math.floor(Math.random()*500))
  })
  $(".tile-group").animate({
    left: 0
  })
}

metro_init()

function showCharms(id){
  var  charm = $(id).data("charm")
  if (charm.element.data("opened") === true) {
    charm.close()
  } else {
    charm.open()
  }
}

function setSearchPlace(el){
  const a = $(el)
  const text = a.text()
  const toggle = a.parents('label').children('.dropdown-toggle')
  toggle.text(text)
}