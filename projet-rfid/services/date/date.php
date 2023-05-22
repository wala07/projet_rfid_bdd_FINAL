<?php
function comparetimes($time1, $time2) {
    $time2 = strtotime($time2);
    $time2 = $time2 + (15 * 60);

    return (strtotime($time1) > $time2);
}

function getdth(){ //get date 2023/5:/21 17:22:55
    $d=date('Y-m-d H:i:s');
    
    return  $d;
    
}
function getdt(){//get date 2023/5:/21
    $d=date('Y-m-d');
    
    return  $d;
    
}
function daynb($date){// get nb jour 9 6 7
    $day = date('j', strtotime($date));
    return $day;
}
function dayname($date){//donne un nom a une date par exemple  9/04 = lundi ..
    $day = date('l', strtotime($date));
    return $day;
}
function deff($dl,$n){//ajout ou revenir d'une semaine
    $d=new DateTime($dl);
    
    if($n>0){
        $r="+$n day";
        
        $d->modify($r);

        
    }
    else{
        $r="$n day";
        
        $d->modify($r);        
        
        
    }
    
    $d=$d->format('Y-m-d');
    
    return $d;

}
function position($d){ // on lui envoi le jour  et elle nous donne le postion exemple lundi = 1 
    $l=['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    for ($i=0;$i<count($l);$i++){
        if($l[$i]==$d){
            return $i;
        }
    }
}

function getalldaysnb($d){ // nb de jour

$x=position(dayname($d));

$l=[];
for($i=0;$i<$x;$i++){
    
    array_push($l,daynb(deff($d,$i-$x)));
}
array_push($l,daynb($d));
for($i=$x+1;$i<7;$i++){
    
    array_push($l,daynb(deff($d,$i-$x)));
}

}function getalldays($d){ // on donne le jour par exemple lundi le 12 return [12,13,14,15,16,17]

    $x=position(dayname($d));
    
    $l=[];
    for($i=0;$i<$x;$i++){
        
        array_push($l,deff($d,$i-$x));
    }
    array_push($l,$d);
    for($i=$x+1;$i<7;$i++){
        
        array_push($l,deff($d,$i-$x));
    }
    
    return $l;
    }

?>