/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */
export function changeSuche(value) {
	var Suchwert = value;
	$.each($("#frm_Zinsrechner input"),function(i,val){
		if($(val).attr('id') == "tb_"+Suchwert){
			$("#"+$(val).attr('id')).addClass('tb_Suche');
			$("#"+$(val).attr('id')).attr('readonly', 'readonly');
                        $("#"+$(val).attr('id')).val(0);
		}else{
			$("#"+$(val).attr('id')).removeClass('tb_Suche');
			$("#"+$(val).attr('id')).removeAttr('readonly');
		}
	});
}