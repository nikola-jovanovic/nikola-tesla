// kod koji fade-uje slike u main divu
$(document).ready(function(){
  function reorder() {
      var grp = $(".pics").children();
      var cnt = grp.length;

      var temp,x;
      for (var i = 0; i < cnt; i++) {
          temp = grp[i];
          x = Math.floor(Math.random() * cnt);
          grp[i] = grp[x];
          grp[x] = temp;
      }
      $(grp).remove();
      $(".pics").append($(grp));
  }
  reorder();
  $(function(){
      $('.pics img:gt(0)').hide();
      setInterval(function(){
        $('.pics :first-child').fadeOut(1000)
           .next('img').fadeIn(1000)
           .end().appendTo('.pics');}, 
        5000);
  });
});

