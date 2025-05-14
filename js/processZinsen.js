/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */
export function processZinsen(data) { 
    $("#tb_"+data.Suchwert).val(data[data.Suchwert]);
	$.post('./php/table.php', {Session: data.Session}, function(table) {
		$("#tbl_Success").html(table);
	});
        /*
	$.post('./php/chart.php', {Session: data.Session}, function(chart) {
		$("#img_Chart").html('<img src="./charts/'+chart+'">');															
	});
        */
        //$("#img_Chart").html('<img src="./php/gdchart.php?Session='+data.Session+'">');
        $("#img_Chart").html('<img src="./php/jpgraph.php?Session='+data.Session+'">');
}