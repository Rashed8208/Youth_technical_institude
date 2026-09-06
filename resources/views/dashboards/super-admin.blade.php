<x-dashboard-shell
    title="Administration Overview"
    eyebrow="Overview"
    description="See what needs attention and reach common tasks without searching through menus.">

    <section aria-labelledby="summary-heading">

        <div class="mb-4 flex items-end justify-between gap-4">
            <div>
                <h2 id="summary-heading" class="text-xl font-black text-slate-950">Institute at a glance</h2>
                <p class="mt-1 text-sm text-slate-600">Live totals from your records.</p>
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

            <x-admin-stat-card label="Students" :value="$statistics['students']" description="Registered student records" tone="blue" :href="route('super-admin.students.index')" />

            <x-admin-stat-card label="Teachers" :value="$statistics['teachers']" description="Teaching staff records" tone="emerald" :href="route('super-admin.teachers.index')" />

            <x-admin-stat-card label="Active courses" :value="$statistics['courses']" description="Programs currently available" tone="violet" :href="route('super-admin.courses.index')" />

            <x-admin-stat-card label="Pending approvals" :value="$statistics['pendingBranches']" description="Branch requests awaiting a decision" tone="amber" :href="route('super-admin.branch-applications.index', ['status'=>'pending'])" />

        </div>

    </section>


    <section class="mt-8 grid gap-6 xl:grid-cols-[1.3fr_0.7fr]">

        <article class="admin-panel">

            <div class="flex flex-wrap items-start justify-between gap-3">

                <div>
                    <p class="text-xs font-black uppercase tracking-[0.16em] text-amber-700">Needs your attention</p>
                    <h2 class="mt-2 text-xl font-black text-slate-950">Branch approvals</h2>
                    <p class="mt-1 text-sm text-slate-600">Review applications before branch access is activated.</p>
                </div>

                <a href="{{ route('super-admin.branch-applications.index', ['status'=>'pending']) }}" class="admin-button admin-button--secondary">
                    View all
                </a>

            </div>


            <div class="mt-5 divide-y divide-slate-100">

                @forelse ($pendingApplications as $application)

                    <a href="{{ route('super-admin.branch-applications.show', $application) }}" class="flex items-center justify-between gap-4 py-4 first:pt-0 last:pb-0">

                        <span class="min-w-0">
                            <span class="block truncate font-black text-slate-900">{{ $application->institute_name }}</span>
                            <span class="mt-1 block text-sm text-slate-500">{{ $application->director_name }} · {{ $application->district }}</span>
                        </span>

                        <span class="shrink-0 text-sm font-black text-blue-700">
                            Review →
                        </span>

                    </a>

                @empty

                    <x-admin-empty-state title="You are all caught up" description="There are no branch applications waiting for review." />

                @endforelse

            </div>

        </article>


        <article class="admin-panel">

            <h2 class="text-xl font-black text-slate-950">Recent activity</h2>

            <p class="mt-1 text-sm text-slate-600">The latest changes across the institute.</p>

            <div class="mt-5 space-y-4">

                @forelse($recentActivity as $activity)

                    <a href="{{ $activity['url'] }}" class="block border-l-2 border-blue-200 pl-4">

                        <span class="block text-xs font-black uppercase tracking-wide text-blue-700">
                            {{ $activity['type'] }}
                        </span>

                        <span class="mt-1 block truncate text-sm font-bold text-slate-800">
                            {{ $activity['label'] }}
                        </span>

                        <span class="mt-1 block text-xs text-slate-500">
                            {{ $activity['date']->diffForHumans() }}
                        </span>

                    </a>

                @empty

                    <p class="text-sm text-slate-500">
                        Activity will appear here when records are added.
                    </p>

                @endforelse

            </div>

        </article>

    </section>


    <section class="mt-8" aria-labelledby="quick-actions-heading">

        <h2 id="quick-actions-heading" class="text-xl font-black text-slate-950">
            Common tasks
        </h2>

        <p class="mt-1 text-sm text-slate-600">
            Start the work office staff perform most often.
        </p>


        <div class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">

            @foreach([
                ['Register a student','Create a complete student record',route('super-admin.students.create')],
                ['Add a teacher','Add a member of teaching staff',route('super-admin.teachers.create')],
                ['Create a course','Set up a department or program',route('super-admin.courses.create')],
                ['Review branch applications','Approve or reject new branches',route('super-admin.branch-applications.index')],
                ['Publish a notice','Share an important public update',route('super-admin.notices.create')],
                ['Enter student results','Choose a student and manage results',route('super-admin.students.index')]
            ] as [$label,$help,$url])

                <a href="{{ $url }}" class="admin-task-card">
                    <span class="font-black text-slate-950">{{ $label }}</span>
                    <span class="mt-1 block text-sm text-slate-600">{{ $help }}</span>
                </a>

            @endforeach

        </div>

    </section>


    <section class="mt-8 grid gap-4 lg:grid-cols-3" aria-label="Management areas">

        <a href="{{ route('super-admin.students.index') }}" class="admin-panel transition hover:border-blue-300">

            <p class="text-xs font-black uppercase tracking-wider text-blue-700">
                People & Branches
            </p>

            <h2 class="mt-2 text-lg font-black">
                Manage people and access
            </h2>

            <p class="mt-2 text-sm leading-6 text-slate-600">
                Students, teachers, and branch approval requests.
            </p>

        </a>


        <a href="{{ route('super-admin.semester-setup.index') }}" class="admin-panel transition hover:border-blue-300">

            <p class="text-xs font-black uppercase tracking-wider text-blue-700">
                Academic Management
            </p>

            <h2 class="mt-2 text-lg font-black">
                Organize academic records
            </h2>

            <p class="mt-2 text-sm leading-6 text-slate-600">
                Courses, semesters, subjects, results, and certificates.
            </p>

        </a>


        <a href="{{ route('super-admin.homepage.items.index','hero') }}" class="admin-panel transition hover:border-blue-300">

            <p class="text-xs font-black uppercase tracking-wider text-blue-700">
                Website Content
            </p>

            <h2 class="mt-2 text-lg font-black">
                Keep the website current
            </h2>

            <p class="mt-2 text-sm leading-6 text-slate-600">
                Homepage sections, notices, news, and institute profile.
            </p>

        </a>

    </section>

</x-dashboard-shell>