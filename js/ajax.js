function $ajax({method,url,data,success,error}){
    var xhr = null;
    try{
        xhr = new XMLHttpRequest();
    }catch(error){
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }

    if(data){
        data = queryString(data);
    }

    if(method == "get" && data){
        url += "?" + data;
    }

    xhr.open(method, url, true);

    if(method == "get"){
        xhr.send();
    }else{
        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        xhr.send(data);
    }

    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4){
            if(xhr.status == 200){
                //判断success是否存在
                if(success){
                    success(xhr.responseText);
                }
            }else{
                if(error){
                    error("Error:" + xhr.status);
                }
            }
        }
    }
}

function queryString(obj){
    var str = "";
    for(var attr in obj){
        str += attr + "=" + obj[attr] + "&";
    }
    return str.substring(0,str.length-1);
}

function getRadioVal(nameVal){
    var inputs=document.getElementsByName(nameVal);
    var checkVal="";
    for(var i=0, len=inputs.length;i<len;i++){
        if(inputs[i].checked){
            checkVal=inputs[i].value;
        }
    }
    return checkVal;
}

function getCheckBoxVal(nameVal){
    var inputs=docement.getElementBysName(nameVal);
    var checkVal=[];
    var k=0;//用来作checkVal数组的下标
    for(var i=0, len=inputs.length;i<len;i++){
        if(inputs[i].checked){
            checkVal[k]=inputs[i].value;
            k++;
        }
    }   
    return checkVal;
}