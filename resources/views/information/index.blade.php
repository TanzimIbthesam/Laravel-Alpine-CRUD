<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Document</title>
    <script defer src="https://unpkg.com/alpinejs@3.5.0/dist/cdn.min.js"></script> 
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</body>
</head>
<body>
    
   <div x-data="postData()">
       {{-- {{informations}} --}}
       <p x-text="name"></p>
          <template x-for="info in informations" :key="info.id">
           <p x-text="info.title"></p>
       </template>   
         <!-- <form x-on:submit.prevent="register"  method="post">
             <input type="text" x-model="from.email" /><br>
             <input type="password" x-model="from.password" /><br>
            <button>Submit</button>

         </form> -->

         <form x-on:submit.prevent="createInfo" >
            <input type="text" x-model="form.title" /><br> 
            <input type="text" x-model="form.description" /><br> 
            <button>Submit</button>

         </form>
       {{-- <div x-if="err">
           {{errors}} 
       </div> --}}
   </div>
     
<script>
   function postData(){
    //    const axios=require("axios");
   
    return{
        name:"Tanzim",
         informations:[],
         errors:[],
         posts:['Post One'],
         form:{
             title:"",
             description:""
         },
        click(){
            console.log("clicked");
        },
//       init() {
//        let infos= fetch('http://127.0.0.1:8000/allinformation')
//        .then(response => response.json())
//        .then(data =>this.informations=data);

        

            
// },
async init() {
        //     // let api=await  fetch('http://127.0.0.1:8000/allinformation');
        //     let response=axios.get('http://127.0.0.1:8000/allinformation');
        // //    let response=await api.json();
        //  console.log(response);
        //      this.informations=response;
         
        //  console.log(this.informations);
        try {
        const resp = await axios.get('http://127.0.0.1:8000/allinformation');
        this.informations=resp.data
        console.log(this.informations);
    } catch (err) {
        // Handle Error Here
        // this.errors=err.message
    }

            
},
      //With Fetch
     createInfo(){
         console.log("Cliked",this.form);
        fetch('http://127.0.0.1:8000/information', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
      },
      body: JSON.stringify(this.form)
    }).then(data=>{
        console.log(data);
        // this.informations+=data
    })
       this.init();
  
        // const resp = await axios.post('http://127.0.0.1:8000/saveinformation',this.form);
        // console.log(resp.data);
   

    }
    //  async createInfo(){
    //      try {
    //         const resp = await axios.post('http://127.0.0.1:8000/saveinformation',this.form);
    //       console.log(resp);
          
    //      } catch (error) {
    //          console.log(error);
    //      }
    //       this.init();
    //  }
    
 }
   } 
  
</script>
</html>