export default {
    state: {
        tasks: []
    },
    mutations: {
        setTasks(state, tasks) {
            state.tasks = tasks;
        },
        deleteTask(state, id) {
         let i = state.tasks.map(item => item.id).indexOf(id); 
         state = state.tasks.splice(i, 1);
        }
    },
    getters:{ 
        getTasks(state){ 
            return state.tasks
        },
        getTaskById(state, id) {
            return state.filter( task => task.id === id)[0];
        }  
    },
    actions: {
        allTasks(context){
           return axios
                .get('http://127.0.0.1:8000/api/tasks') 
                .then((response) => {
                    console.log(response.data.tasks)
                    context.commit('setTasks', response.data.tasks);
                })
        },
        deleteTask({ commit }, id) { 
          return axios 
          .delete(`http://127.0.0.1:8000/api/task/delete/${id}`)
          .then(response => {
                commit('deleteTask', response.task.id);
          });
        }

    },
}