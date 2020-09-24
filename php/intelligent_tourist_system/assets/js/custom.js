$(document).ready(function(e){

	var spinner_load = '<div class="text-center p-3"><span class="spinner-border"></span></div>';

	$("#plan_area").change(function(){

		let area = $(this).val(),
			viewport = $("#plan_places");

		viewport.html(spinner_load);

		$.get('plan/fetch_places/'+area, function(result) {
			
			// console.log(result);

			try{

				let data = JSON.parse(result);

				if(data["status"]){
					viewport.html(data["data"]);
				}else{
					viewport.html("<div class='text-center'>Record not found!</div>")
				}
			}
			catch(e){
				console.log("issue");
			}

		});

	});



});