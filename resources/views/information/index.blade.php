<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Document</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    
</body>
</head>
<body>
    
   <div x-data="postData()" class="mx-auto flex flex-col justify-center items-center">
       {{-- {{informations}} --}}
        <div class="m-5"> 
            <button class="px-4 py-1 bg-green-300 text-white rounded-md" x-on:click="shownHideForm">Add Form</button>
        </div>
      
     
       
  
   <div> 
    
       <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      id
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Title
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Description
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Actions
                    </th>
                    
                    
                    
                    
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <template x-for="info in informations" :key="index">
                  <tr>
             
        
        
                    <td class="px-6 py-4 ">
                      <div class="flex items-center" x-text="info.id">
                       
                      </div>
                    </td>
                    <td class="px-6 py-4 ">
                      <div class="text-sm text-gray-900" x-text="info.title"></div>
                      
                    </td>
                    <td class="px-6 py-4 ">
                        <div class="text-sm text-indigo-600" x-text="info.description"></div>
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="px-4 py-1 bg-red-800 text-white rounded-md" x-on:click="deleteInfo(info.id)">Delete</button>
                        <button class="px-4 py-1 bg-blue-600 text-white rounded-md" x-on:click="shownEditHideForm(info.id)">Edit</button>
                        <form x-show="showEditForm" x-on:submit.prevent="editInfo(info.id)"  class="space-y-3 mt-3 -mt-16 bg-blue-600">
           
                          <input type="text" class="py-1 px-4 border rounded-md w-64" x-model="info.title"/><br> 
           
                          <input type="text" class="py-1 px-4 border rounded-md w-64" x-model="info.description"/><br> 
                        
                          
                         
                           
                          
                          <button class="py-1 px-6 bg-blue-500 rounded-md">Submit</button> 
                          
                           
                        </form> 
                       
                    </td>
                  </tr>
                </template>
                  <!-- More people... -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
   </div>
  
           
            {{-- Data Insert form --}}
            <form x-show="isShown" x-on:submit.prevent="createInfo" class="space-y-3 mt-3" >
           
                <input type="text" value="Title" class="py-1 px-4 border rounded-md w-64" x-model="form.title" /><br> 
                <template x-if="errors.title">
                    <div x-text="titleerrors()" class="text-red-500 font-serif "></div>
                     </template> 
                <input type="text" value="Description" class="py-1 px-4 border rounded-md w-64" x-model="form.description" /><br> 
                {{-- <input class="py-1 px-4 border rounded-md w-64" type="text" id="fname" name="fname" value="John"><br><br>  --}}
                   <template x-if="errors.description">
                    <div class="text-red-500 font-serif " x-text="descriptionerrors()"></div>
                     </template>  
                
                <button class="py-1 px-6 bg-blue-500 rounded-md ">Submit</button>
               
                
             </form>
             
       
        
     
   </div>
   <div>
   
   </div>
<script defer src="https://unpkg.com/alpinejs@3.5.0/dist/cdn.min.js"></script> 
<script src="https://unpkg.com/axios/dist/axios.min.js"></script> 
<script>
   function postData(){
    //    const axios=require("axios");
   
    return{
        name:"Tanzim",
         informations:[],
         isShown:false,
         showEditForm:false,
         
         errors:[],
         
            isLoggedIn:false,
         posts:['Post One'],
         form:{
             title:"",
             description:""
         },
        click(){
            console.log("clicked");
        },
        titleerrors(){
           return this.errors.title.join(" ");
        },
        descriptionerrors(){
           return this.errors.description.join(" ");
        },
        shownHideForm(e){
            e.stopPropagation();
            console.log("clicked");
           return this.isShown = !this.isShown
        },
        shownEditHideForm(id){
            // e.stopPropagation();
            console.log(id);
            console.log("clicked edit");
           return this.showEditForm = !this.showEditForm
           axios.get(`http://127.0.0.1:8000/information/`+id)
           .then(response=>console.log(response.data))
        },
       
    


        

            

async init() {
     
        
        try {
        const resp = await axios.get('http://127.0.0.1:8000/allinformation');
        this.informations=resp.data
        console.log(this.informations);
    } catch (err) {
        // Handle Error Here
         this.errors=err.message
         console.log(err);
        
    }

            
},

     async createInfo(){
              try {
                const response = await axios.post('http://127.0.0.1:8000/information',this.form);
               console.log(response);
               this.form='';
          this.init()
              } catch (error) {
                 
                    if(error.response.status === 422) {
                        this.errors = error?.response?.data?.errors;
                          console.log(this.errors);
                 
              }
          
     }
    
 },
// async editInfo(id){
//   console.log("Edit",id);
//  await axios.patch(`http://127.0.0.1:8000/information/`+id,this.form)
//   .then(response=>console.log(response))
//    },


   //   Problems will resolve in future       },
 async deleteInfo(id){
     try {
      
        await  axios.delete(`http://127.0.0.1:8000/information/`+id)
           
            this.init(); 
     } catch (error) {
         console.log(error);
     }
 
    }
    
  
   
    
}
}


  
</script>
</html>