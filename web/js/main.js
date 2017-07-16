$(function(){
	$(document).on('click','.fc-day',function(){
		var date = $(this).attr('data-date');

		$.get('index.php?r=event/create',{'date':date},function(data){
			$('#modal').modal('show')
            .find('#modalContent')
            .html(data);	
		});
	});

	// get the click of the create button 
	$('#modalButton').click(function (){
        $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
    });
});


//function DateComparisionJavascriptFun()
//{
//    var a=document.getElementById("formulir-nilai").value;
//    var b=document.getElementById("formulir-kuantitas").value;
//    document.getElementById("formulir-ak").value=a*b;
//    //c=a*b;
//   // alert(c);
//}  


