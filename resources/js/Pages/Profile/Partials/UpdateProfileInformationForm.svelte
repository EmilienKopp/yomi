<script lang="ts">
  import InputError from '$components/InputError.svelte';
  import InputLabel from '$components/InputLabel.svelte';
  import PrimaryButton from '$components/PrimaryButton.svelte';
  import TextInput from '$components/TextInput.svelte';
  import { Link, useForm, page } from '@inertiajs/svelte';
  import { fade } from 'svelte/transition';
  
  interface Props {
    mustVerifyEmail?: boolean;
    status?: string;
  }
  
  let { mustVerifyEmail = false, status = '' }: Props = $props();
  
  const user = $page.props.auth.user;
  
  const form = useForm({
    name: user.name,
    email: user.email,
  });
</script>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Profile Information
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Update your account's profile information and email address.
        </p>
    </header>

    <form
        onsubmit={(e: Event) => {
          e.preventDefault();
          form.patch(route('profile.update'))
          }
        }
        class="mt-6 space-y-6"
    >
        <div>
            <InputLabel for="name" value="Name" />

            <TextInput
                id="name"
                type="text"
                class="mt-1 block w-full"
                bind:value={form.name}
                required
                autofocus
                autocomplete="name"
            />

            <InputError class="mt-2" message={form.errors.name} />
        </div>

        <div>
            <InputLabel for="email" value="Email" />

            <TextInput
                id="email"
                type="email"
                class="mt-1 block w-full"
                bind:value={form.email}
                required
                autocomplete="username"
            />

            <InputError class="mt-2" message={form.errors.email} />
        </div>

        {#if mustVerifyEmail && user.email_verified_at === null}
            <p class="mt-2 text-sm text-gray-800">
                Your email address is unverified.
                <Link
                    href={route('verification.send')}
                    method="post"
                    as="button"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Click here to re-send the verification email.
                </Link>
            </p>

            {#if status === 'verification-link-sent'}
                <div
                    class="mt-2 text-sm font-medium text-green-600"
                >
                    A new verification link has been sent to your email address.
                </div>
            {/if}
        {/if}

        <div class="flex items-center gap-4">
            <PrimaryButton disabled={form.processing}>Save</PrimaryButton>

            {#if form.recentlySuccessful}
                <p
                    transition:fade
                    class="text-sm text-gray-600"
                >
                    Saved.
                </p>
            {/if}
        </div>
    </form>
</section>
