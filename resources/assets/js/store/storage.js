export default {
    set(key,message){
        localStorage.setItem(key,message)
    },
    remove(key){
            localStorage.removeItem(key)
    },
    get(key){
        //remove the local storage value for the specific key after 10 seconds
        setTimeout(()=>{
                this.remove(key)
            },10000)
        return localStorage.getItem(key);
    }
}