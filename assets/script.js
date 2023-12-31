window.addEventListener("load", function(){
    // Store the tabs variables
    let tabs = document.querySelectorAll("ul.nav-tabs > li");
    for(let i = 0; i < tabs.length; i++){
        let tab = tabs[i];
        tab.addEventListener("click", switchTab);
    }


    function switchTab(event){
        event.preventDefault();
        document.querySelector("ul.nav-tabs li.active").classList.remove("active");
        document.querySelector(".tab-content .tab-pane.active").classList.remove("active");
        let clickedTab = event.currentTarget;
        let anchor = event.target;
        let activePaneID = anchor.getAttribute("href");
        clickedTab.classList.add("active");
        document.querySelector(activePaneID).classList.add("active");
    }
});

