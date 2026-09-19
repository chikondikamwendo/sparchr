<section class="max-w-2xl px-6 py-8 mx-auto bg-white dark:bg-gray-900">
    <header>
        <a href="{{ url() }}">
            Sparc Systems
        </a>
    </header>

    <main class="mt-8">
        <h2 class="text-gray-700 dark:text-gray-200">Hi {{ $applicant }},</h2>

        <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
            Your application for the following vacancy: {{ $vacancy }} was successfully received.
            We have begun our review process and will be in touch with results soon.
        </p>

        <p class="mt-2 text-gray-600 dark:text-gray-300">
            Thank you for applying, <br>
            Sparc Systems team
        </p>
    </main>

    <footer class="mt-8">
        <p class="mt-3 text-gray-500 dark:text-gray-400">© 2026 Sparc Systems. All Rights Reserved.</p>
    </footer>
</section>