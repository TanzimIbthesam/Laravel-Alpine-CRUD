<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script defer src="https://unpkg.com/alpinejs@3.5.0/dist/cdn.min.js"></script> 
</body>
</head>
<body>
    
   <div x-data="postData()" x-init="init()">
       {{informations}}
       <p x-text="name"></p>
          {{-- <template x-for="user in users" :key="user.id">
           <p x-text="user.first_name"></p>
       </template>    --}}
         <!-- <form x-on:submit.prevent="register"  method="post">
             <input type="text" x-model="from.email" /><br>
             <input type="password" x-model="from.password" /><br>
            <button>Submit</button>

         </form> -->

         <form x-on:submit.prevent="register" >
            <input type="text" x-model="form.email" /><br> 
            <input type="password" x-model="form.password" /><br> 
            <button>Submit</button>

         </form>
       Hello
   </div>
     
<script>
   function postData(){
    return{
        name:"Tanzim",
         users:[],
         posts:['Post One'],
         form:{
             email:"",
             password:""
         },
        click(){
            console.log("clicked");
        },
       init() {
            let api=fetch('http://127.0.0.1:8000/information');
            console.log(api);
            
         //    return await response;
            // console.log(response.data);
            //  this.users=response.data
         //    this.users=response;

            
},
     register(){
        //   console.log(this.form);
        console.log("Registered",this.form);
    }


       

    }
 } 
  
</script>
</html>