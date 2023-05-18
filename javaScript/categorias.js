$(document).ready(function(){
  document.cookie='catId=0';
  $('#cat').change(function(){
    var value = $(this).val();
    document.cookie='catId='+value+'';
    $('#products').load(location.href +' #products');
  });
});
