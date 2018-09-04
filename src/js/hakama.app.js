/**
 * Description
 */

/*global hoge: true*/

(($)=>{

  $(document).ready(()=>{
    let $toggle = $('.global-nav-toggle');
    if ($toggle.length) {
      $toggle.click((e) => {
        $toggle.toggleClass('toggle');
      });
    }
  });

})(jQuery);
