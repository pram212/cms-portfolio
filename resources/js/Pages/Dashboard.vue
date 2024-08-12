<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <div class="grid grid-cols-3 gap-10">

        <div class="card bg-base-100 shadow-xl">
          <div class="card-body">
            <h2 class="card-title">Biodata</h2>
            <p>manage your biodata such as name, address, and others.</p>
            <div class="card-actions justify-end">
              <Link :href="route('biodata.index')" class="btn btn-primary">Go</Link>
            </div>
          </div>
        </div>
  
        <div class="card bg-base-100 shadow-xl">
          <div class="card-body">
            <h2 class="card-title">Contact</h2>
            <p>manage your contact such as phone, address, and others.</p>
            <div class="card-actions justify-end">
              <Link :href="route('contact.index')" class="btn btn-primary">Go</Link>
            </div>
          </div>
        </div>

        <div class="card bg-base-100 shadow-xl">
          <div class="card-body">
            <h2 class="card-title">Education</h2>
            <p>manage your education experience.</p>
            <div class="card-actions justify-end">
              <Link :href="route('educations.index')" class="btn btn-primary">Go</Link>
            </div>
          </div>
        </div>

        <div class="card bg-base-100 shadow-xl">
          <div class="card-body">
            <h2 class="card-title">Experience</h2>
            <p>manage your education experience.</p>
            <div class="card-actions justify-end">
              <Link :href="route('experiences.index')" class="btn btn-primary">Go</Link>
            </div>
          </div>
        </div>

        <div class="card bg-base-100 shadow-xl">
          <div class="card-body">
            <h2 class="card-title">Skill</h2>
            <p>manage your skill.</p>
            <div class="card-actions justify-end">
              <Link :href="route('skills.index')" class="btn btn-primary">Go</Link>
            </div>
          </div>
        </div>

        <div class="card bg-base-100 shadow-xl">
          <div class="card-body">
            <h2 class="card-title">Course</h2>
            <p>manage your course.</p>
            <div class="card-actions justify-end">
              <Link :href="route('courses.index')" class="btn btn-primary">Go</Link>
            </div>
          </div>
        </div>

        <div class="card bg-base-100 shadow-xl">
          <div class="card-body">
            <h2 class="card-title">Client</h2>
            <p>manage your client.</p>
            <div class="card-actions justify-end">
              <Link :href="route('clients.index')" class="btn btn-primary">Go</Link>
            </div>
          </div>
        </div>

        <div class="card bg-base-100 shadow-xl">
          <div class="card-body">
            <h2 class="card-title">Link</h2>
            <p>manage your links social media such as linkedin, github, gitlab and other.</p>
            <div class="card-actions justify-end">
              <Link :href="route('links.index')" class="btn btn-primary">Go</Link>
            </div>
          </div>
        </div>

    </div>
  </AuthenticatedLayout>
</template>
