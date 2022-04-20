<script lang="ts">
import { todos } from "@/stores/todos"

export default {
  setup() {
    const store = todos()

    return {
      store,
    }
  },
}
</script>

<template>
  <div class="unfinished">
    <h1>Unfinished Todos ({{ store.unfinishedTodos.length }})</h1>

    <ul>
      <li
          v-for="todo in store.unfinishedTodos"
          @click="store.changeFinished(todo.id)"
          :class="{'done': todo.isFinished}"
          :key="todo.id"
      >{{ todo.text }}</li>
    </ul>

  </div>
</template>

<style>
@media (min-width: 1024px) {
  .about {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
}
</style>
