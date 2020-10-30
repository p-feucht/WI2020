function toggle(rowCount, tablenr) {
    myHead = document.getElementById("td-head-"+ tablenr);
    myRowSpan = myHead.rowSpan;
    
    if (myHead.rowSpan==rowCount+1) {
    // zuklappen
        for (i=1;i<=rowCount;i++) {
            currentTr = document.getElementById("td-data-"+tablenr+i);     
            currentTr.style.display = "none";
            
        }
        myHead.rowSpan=1;
    
    } else {
        // aufklappen
        for (i=1;i<=rowCount;i++) {
            currentTr = document.getElementById("td-data-"+tablenr+i);     
            currentTr.style.display = "";
            
        }
        myHead.rowSpan=rowCount+1;
    }    
    
    }