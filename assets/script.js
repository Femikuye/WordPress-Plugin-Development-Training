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


jQuery(document).ready(function($){
    console.log("Helloo jQuery");
    $(document).on("click", ".js-biem-image-banner-picker", function(e){
        e.preventDefault();
        let _this  = $(this);
        
        let selection_dialog = wp.media.frames.file_frame = wp.media({
            title: 'Select Or Upload An Image',
            library: {
                type: 'image'
            },
            button: {
                text: 'Select Image'
            },
            multiple: false
        });
        selection_dialog.on("select", function(){
            let selected_file = selection_dialog.state().get("selection").first().toJSON();
            console.log("selected_file: ", selected_file);
            _this.siblings(".biem-image-input").val(selected_file.url);
            $(".js-biem-image-banner-picker > img").attr("src", selected_file.url);
        })
        selection_dialog.open();
    });
    $(document).on("click", ".js-biem-bg-image-banner-picker", function(e){
        e.preventDefault();
        let _this  = $(this);
        
        let selection_dialog = wp.media.frames.file_frame = wp.media({
            title: 'Select Or Upload An Image',
            library: {
                type: 'image'
            },
            button: {
                text: 'Select Image'
            },
            multiple: false
        });
        selection_dialog.on("select", function(){
            let selected_file = selection_dialog.state().get("selection").first().toJSON();
            _this.siblings(".biem-image-input").val(selected_file.url);
            $(".js-biem-bg-image-banner-picker > img").attr("src", selected_file.url);
        })
        selection_dialog.open();
    });
});
