    <form method="post" class="w-full max-w-2xl mx-auto bg-gray-100 dark:bg-gray-900 p-8 rounded-2xl border border-gray-300 dark:border-gray-700 space-y-6">
        @csrf
        <x-form-field name="name" required/>
        <x-form-field type="email" required/>
        <x-form-field name="subject" required/>
        <x-form-field name="message" type="textarea"/>
        <x-form-button value="Send"/>
    </form>
