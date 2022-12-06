class Image {
    constructor(src, x, y, width, height) {
        this.image = document.createElement("img");
        this.image.src = src;
        this.image.style.position = "absolute";
        this.image.style.left = x+"px";
        this.image.style.top = y+"px";
        this.image.width = width;
        this.image.height = height;
        document.body.appendChild(this.image);
    }
    
    show() {
        this.image.style.visibility = "visible";
    }
    
    hide() {
        this.image.style.visibility = "hidden";
    }
    
    putAt(x, y) {
        this.image.style.left = x+"px";
        this.image.style.top = y+"px";        
    }
    
    resize(width, height) {
        this.image.width = width;
        this.image.height = height;    
    }
}

