<script lang="ts">
  import { HTMLInputAttributes } from "svelte/elements";

  interface Props extends HTMLInputAttributes {
    message?: string;
  }
  
  let { message = '' }: Props = $props();
</script>

{#if message}
    <p class="text-sm text-red-600">
        {message}
    </p>
{/if}
