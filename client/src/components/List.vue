<template>
    <div id="todo-list-example" class="container">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <h1 class="text-center">TODO List App</h1>
          <form v-on:submit.prevent="addNewTask">
            <label for="titleinput">Task Name</label>
            <input v-model="title" id="titleinput" class="form-control" placeholder="Add New Task">
            <label for="titleinput">Task Detail</label>
            <input v-model="detail" id="detailinput" class="form-control" placeholder="Add New Task Detail">
            <button v-if="this.isEdit == false" type="submit" class="btn btn-success btn-block  mt-3">
              Submit
            </button>
            <button v-else type="button" v-on:click="updateTask()" class="btn btn-primary btn-block  mt-3">
              Update
            </button>
          </form>

          <table class="table">
            <tr v-for="(todo) in todos" v-bind:key="todo.id" v-bind:task_name="todo.task_name">
              <td class="text-left">{{todo.title}}</td>
              <td class="text-center">{{todo.detail}}</td>
              <td class="text-right">
                <button v-on:click="editTask(todo.title, todo.id)" class=" btn btn-info ">Edit</button>
                <button v-on:click="deleteTask(todo.id)" class=" btn btn-danger ">Delete</button>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
  data () {
    return {
      todos: [],
      id: '',
      title: '',
      detail:'',
      isEdit: false
    }
  },
  mounted () {
    this.getTasks()
  },
  methods: {
    getTasks () {
      axios({ method: 'GET', url: '/api/todos' }).then(
        result => {
          console.log(result.data)
          this.todos = result.data
        },
        error => {
          console.error(error)
        }
      )
    },
    addNewTask () {
      axios.post('/api/todos',
        { title: this.title, detail: this.detail }
      ).then((res) => {
        this.title = ''
        this.detail = ''
        this.getTasks()
        console.log(res)
      }).catch((err) => {
        console.log(err)
      })
    },
    editTask (title, id) {
      this.id = id
      this.title = title
      this.isEdit = true
    },
    updateTask () {
      axios.put(`/api/todos/${this.id}`,
        { title: this.title, detail:this.detail }
      ).then((res) => {
        this.title = ''
         this.detail = ''
        this.isEdit = false
        this.getTasks()
        console.log(res)
      }).catch((err) => {
        console.log(err)
      })
    },
    deleteTask (id) {
      axios.delete(`/api/todos/${id}`
      ).then((res) => {
        this.title = ''
        this.getTasks()
        console.log(res)
      }).catch((err) => {
        console.log(err)
      })
    }
  }
}
</script>