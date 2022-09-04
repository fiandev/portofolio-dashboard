const nav_Height = $(".navbar").innerHeight()
const pathname = window.location.pathname
const currentUrl = window.location.origin + pathname
$(document).ready(function(){
  
  $(window).on("scroll", function(){
    let top = window.scrollY
    let position = (top === 0) ?  "relative" : "fixed"
    $(".navbar").css({
      "position": position,
      "z-index": 4,
      "top": "0",
      "left": "0",
      "right": "0"
    })
    
    $(".navbar")[ (top > 100) ? "addClass" : "removeClass"] ("navScrolled")
    
  })
  
  $(".navbar-toggler").on("click", function(){
    $(".navbar").removeClass("navScrolled")
  })
  
  $(".fa-brands").each(function(i){
    let brand = $(this).attr("class").split("fa-brands fa-").join("")
    $(this).attr("brand", brand)
  })
  
  $(".widget-rocket").on("click", function(){
    window.scroll({
      top: 0,
      behavior: 'smooth'
    })
    $(".widget-rocket").addClass("d-none")
    setTimeout(function() {
      $(window).on("scroll", function(){
        $(".widget-rocket").removeClass("d-none")
      })
    }, 1000);
  })
  
  /* ads section */
  $(".ads").each(function(){
    let w = $(this).innerWidth()
    let h = $(this).innerHeight()
    let r = gcd(w, h)
    $(this).html(`ads ${ Math.floor(w/r).toString().slice(0, 3) }:${ Math.floor(h/r).toString().slice(0, 3) }`)
  })
  $(".ads").append(`
    <div class="close-btn">
      <i class="fa fa-xmark"></i>
    </div>
  `)
  $(".ads-rectangle-banner").css("height", $(".ads-rectangle-banner").innerWidth())
  $(".ads .close-btn").on("click", function(){
    $(this).parent().fadeOut()
  })
  $(".preload").remove()
})


function gcd(a, b) {
  return (b == 0) ? a : gcd (b, a % b)
}