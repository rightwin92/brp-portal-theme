jQuery(function($){
  $('#brpt-apply').on('click', function(){
    const type = $('#brpt-type').val().toLowerCase();
    const city = $('#brpt-city').val().toLowerCase();
    const q    = $('#brpt-q').val().toLowerCase();
    $('.brpt-card').each(function(){
      const $c = $(this);
      const inType = type==='' || $c.find('.brpt-meta').text().toLowerCase().includes(type);
      const inCity = city==='' || $c.text().toLowerCase().includes(city);
      const inQ    = q===''    || $c.text().toLowerCase().includes(q);
      $c.toggle(inType && inCity && inQ);
    });
  });
});
