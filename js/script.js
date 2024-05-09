Vue.createApp({
    data(){
        return{
            todoList: [], 
            input: '',
            todoTemp:{},
            apiurl: 'controll/server.php'
        }
    },
    methods: {
        deleteTodo: function(index){
            const data ={
                id : index
            };
            axios.delete(this.apiurl,{ data }).then((res)=>{
                this.todoList= res.data;
                console.log(this.todoList);
            });
        },
        changeStatus: function(object){
            if(object.done){
                object.done= false;
            }
            else{
                object.done= true;
            }
        },
        getData: function(){
            axios.get(this.apiurl).then((res)=>{
                this.todoList= res.data;
                console.log(this.todoList);
            })
        },
        addTodo: function(){
            this.todoTemp={};
            this.todoTemp.done=false;
            this.todoTemp.text= this.input;
            this.todoTemp.id= (this.todoList.length + 1)
            this.input='';
            const data= new FormData();
            for (let key in this.todoTemp) {
                data.append(key,this.todoTemp[key])
            }
            axios.post(this.apiurl,data).then((res)=>{
                 this.todoList = res.data;
                 console.log(this.todoList);
            });
        }

    },
    computed:{
        
    },
    mounted(){
        this.getData();
    }
}).mount('#app')