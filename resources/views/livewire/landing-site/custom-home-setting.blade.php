<div class="space-y-6">

    <form wire:submit.prevent="save">

        {{-- Hero --}}
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <h3 class="mb-4 text-lg font-semibold dark:text-white">@lang('modules.settings.heroSection')</h3>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <x-label for="heroSubtitle" value="{{ __('modules.settings.subtitle') }}" />
                    <x-input id="heroSubtitle" class="block mt-1 w-full" type="text" wire:model.defer="data.hero.subtitle" />
                </div>
                <div>
                    <x-label for="heroPrimary" value="{{ __('modules.settings.primaryButton') }}" />
                    <x-input id="heroPrimary" class="block mt-1 w-full" type="text" wire:model.defer="data.hero.primary_btn" />
                </div>
                <div class="md:col-span-2">
                    <x-label for="heroTitle" value="{{ __('modules.settings.title') }}" />
                    <x-input id="heroTitle" class="block mt-1 w-full" type="text" wire:model.defer="data.hero.title" />
                </div>
                <div class="md:col-span-2">
                    <x-label for="heroParagraph" value="{{ __('modules.settings.description') }}" />
                    <x-textarea id="heroParagraph" class="block mt-1 w-full" wire:model.defer="data.hero.paragraph"></x-textarea>
                </div>
                <div>
                    <x-label for="heroCard1Label" value="{{ __('modules.settings.stat1Label') }}" />
                    <x-input id="heroCard1Label" class="block mt-1 w-full" type="text" wire:model.defer="data.hero.card1_label" />
                </div>
                <div>
                    <x-label for="heroCard1Value" value="{{ __('modules.settings.stat1Value') }}" />
                    <x-input id="heroCard1Value" class="block mt-1 w-full" type="text" wire:model.defer="data.hero.card1_value" />
                </div>
                <div>
                    <x-label for="heroCard2Label" value="{{ __('modules.settings.stat2Label') }}" />
                    <x-input id="heroCard2Label" class="block mt-1 w-full" type="text" wire:model.defer="data.hero.card2_label" />
                </div>
                <div>
                    <x-label for="heroCard2Value" value="{{ __('modules.settings.stat2Value') }}" />
                    <x-input id="heroCard2Value" class="block mt-1 w-full" type="text" wire:model.defer="data.hero.card2_value" />
                </div>
                <div class="md:col-span-2">
                    <x-label for="heroImage" value="{{ __('modules.settings.heroImage') }}" />
                    <input type="file" id="heroImage" wire:model="heroImage"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-skin-base/10 file:text-skin-base hover:file:bg-skin-base/20">
                    @if (!empty($data['hero']['image']))
                        <div class="mt-2 flex items-center gap-3">
                            <img src="{{ asset_url_local_s3('landing_home/' . $data['hero']['image']) }}" class="w-32 rounded" alt="">
                            <button type="button" wire:click="removeImage('hero.image')" class="text-sm text-red-600">@lang('app.remove')</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Brand --}}
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <h3 class="mb-4 text-lg font-semibold dark:text-white">@lang('modules.settings.brandSection')</h3>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="md:col-span-2">
                    <x-label for="brandTitle" value="{{ __('modules.settings.title') }}" />
                    <x-input id="brandTitle" class="block mt-1 w-full" type="text" wire:model.defer="data.brand.title" />
                </div>
                @foreach ($data['brand']['logos'] as $i => $logo)
                    <div>
                        <x-label for="brandLogo{{ $i }}" value="{{ __('modules.settings.logo') }} {{ $i + 1 }}" />
                        <input type="file" id="brandLogo{{ $i }}" wire:model="brandLogos.{{ $i }}"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-skin-base/10 file:text-skin-base hover:file:bg-skin-base/20">
                        @if (!empty($data['brand']['logos'][$i]))
                            <img src="{{ asset_url_local_s3('landing_home/' . $data['brand']['logos'][$i]) }}" class="mt-2 w-24 rounded" alt="">
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        {{-- About --}}
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <h3 class="mb-4 text-lg font-semibold dark:text-white">@lang('modules.settings.aboutSection')</h3>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <x-label for="aboutSubtitle" value="{{ __('modules.settings.subtitle') }}" />
                    <x-input id="aboutSubtitle" class="block mt-1 w-full" type="text" wire:model.defer="data.about.subtitle" />
                </div>
                <div>
                    <x-label for="aboutFactValue" value="{{ __('modules.settings.factValue') }}" />
                    <x-input id="aboutFactValue" class="block mt-1 w-full" type="text" wire:model.defer="data.about.fact_value" />
                </div>
                <div class="md:col-span-2">
                    <x-label for="aboutTitle" value="{{ __('modules.settings.title') }}" />
                    <x-input id="aboutTitle" class="block mt-1 w-full" type="text" wire:model.defer="data.about.title" />
                </div>
                <div class="md:col-span-2">
                    <x-label for="aboutParagraph1" value="{{ __('modules.settings.paragraph') }} 1" />
                    <x-textarea id="aboutParagraph1" class="block mt-1 w-full" wire:model.defer="data.about.paragraph1"></x-textarea>
                </div>
                <div class="md:col-span-2">
                    <x-label for="aboutParagraph2" value="{{ __('modules.settings.paragraph') }} 2" />
                    <x-textarea id="aboutParagraph2" class="block mt-1 w-full" wire:model.defer="data.about.paragraph2"></x-textarea>
                </div>
                <div>
                    <x-label for="aboutFeature1Title" value="{{ __('modules.settings.feature') }} 1 {{ __('app.title') }}" />
                    <x-input id="aboutFeature1Title" class="block mt-1 w-full" type="text" wire:model.defer="data.about.feature1_title" />
                </div>
                <div>
                    <x-label for="aboutFeature2Title" value="{{ __('modules.settings.feature') }} 2 {{ __('app.title') }}" />
                    <x-input id="aboutFeature2Title" class="block mt-1 w-full" type="text" wire:model.defer="data.about.feature2_title" />
                </div>
                <div class="md:col-span-2">
                    <x-label for="aboutFeature1Text" value="{{ __('modules.settings.feature') }} 1 {{ __('modules.settings.description') }}" />
                    <x-textarea id="aboutFeature1Text" class="block mt-1 w-full" wire:model.defer="data.about.feature1_text"></x-textarea>
                </div>
                <div class="md:col-span-2">
                    <x-label for="aboutFeature2Text" value="{{ __('modules.settings.feature') }} 2 {{ __('modules.settings.description') }}" />
                    <x-textarea id="aboutFeature2Text" class="block mt-1 w-full" wire:model.defer="data.about.feature2_text"></x-textarea>
                </div>
                <div>
                    <x-label for="aboutFactLabel" value="{{ __('modules.settings.factLabel') }}" />
                    <x-input id="aboutFactLabel" class="block mt-1 w-full" type="text" wire:model.defer="data.about.fact_label" />
                </div>
                <div>
                    <x-label for="aboutImage" value="{{ __('modules.settings.aboutImage') }}" />
                    <input type="file" id="aboutImage" wire:model="aboutImage"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-skin-base/10 file:text-skin-base hover:file:bg-skin-base/20">
                    @if (!empty($data['about']['image']))
                        <div class="mt-2 flex items-center gap-3">
                            <img src="{{ asset_url_local_s3('landing_home/' . $data['about']['image']) }}" class="w-32 rounded" alt="">
                            <button type="button" wire:click="removeImage('about.image')" class="text-sm text-red-600">@lang('app.remove')</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Services --}}
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold dark:text-white">@lang('modules.settings.servicesSection')</h3>
                <x-button type="button" wire:click="addService">@lang('modules.settings.addService')</x-button>
            </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="md:col-span-2">
                    <x-label for="servicesSubtitle" value="{{ __('modules.settings.subtitle') }}" />
                    <x-input id="servicesSubtitle" class="block mt-1 w-full" type="text" wire:model.defer="data.services.subtitle" />
                </div>
                <div class="md:col-span-2">
                    <x-label for="servicesTitle" value="{{ __('modules.settings.title') }}" />
                    <x-input id="servicesTitle" class="block mt-1 w-full" type="text" wire:model.defer="data.services.title" />
                </div>
                @foreach ($data['services']['items'] as $i => $item)
                    <div class="md:col-span-2 border p-3 rounded dark:border-gray-600">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium dark:text-white">#{{ $i + 1 }}</span>
                            <button type="button" wire:click="removeService({{ $i }})" class="text-sm text-red-600">@lang('app.delete')</button>
                        </div>
                        <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                            <div>
                                <x-label for="serviceTitle{{ $i }}" value="{{ __('app.title') }}" />
                                <x-input id="serviceTitle{{ $i }}" class="block mt-1 w-full" type="text" wire:model.defer="data.services.items.{{ $i }}.title" />
                            </div>
                            <div>
                                <x-label for="serviceIcon{{ $i }}" value="{{ __('modules.settings.icon') }}" />
                                <input type="file" id="serviceIcon{{ $i }}" wire:model="serviceIcons.{{ $i }}"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-skin-base/10 file:text-skin-base hover:file:bg-skin-base/20">
                                @if (!empty($item['icon']))
                                    <img src="{{ asset_url_local_s3('landing_home/' . $item['icon']) }}" class="mt-2 w-16 rounded" alt="">
                                @endif
                            </div>
                            <div class="md:col-span-2">
                                <x-label for="serviceText{{ $i }}" value="{{ __('modules.settings.description') }}" />
                                <x-textarea id="serviceText{{ $i }}" class="block mt-1 w-full" wire:model.defer="data.services.items.{{ $i }}.text"></x-textarea>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- FAQ --}}
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold dark:text-white">@lang('modules.settings.faqSection')</h3>
                <x-button type="button" wire:click="addFaq">@lang('modules.settings.addFaq')</x-button>
            </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <x-label for="faqSubtitle" value="{{ __('modules.settings.subtitle') }}" />
                    <x-input id="faqSubtitle" class="block mt-1 w-full" type="text" wire:model.defer="data.faq.subtitle" />
                </div>
                <div>
                    <x-label for="faqTitle" value="{{ __('modules.settings.title') }}" />
                    <x-input id="faqTitle" class="block mt-1 w-full" type="text" wire:model.defer="data.faq.title" />
                </div>
                <div class="md:col-span-2">
                    <x-label for="faqImage" value="{{ __('modules.settings.faqImage') }}" />
                    <input type="file" id="faqImage" wire:model="faqImage"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-skin-base/10 file:text-skin-base hover:file:bg-skin-base/20">
                    @if (!empty($data['faq']['image']))
                        <div class="mt-2 flex items-center gap-3">
                            <img src="{{ asset_url_local_s3('landing_home/' . $data['faq']['image']) }}" class="w-32 rounded" alt="">
                            <button type="button" wire:click="removeImage('faq.image')" class="text-sm text-red-600">@lang('app.remove')</button>
                        </div>
                    @endif
                </div>
                @foreach ($data['faq']['items'] as $i => $item)
                    <div class="md:col-span-2 border p-3 rounded dark:border-gray-600">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium dark:text-white">#{{ $i + 1 }}</span>
                            <button type="button" wire:click="removeFaq({{ $i }})" class="text-sm text-red-600">@lang('app.delete')</button>
                        </div>
                        <div class="grid grid-cols-1 gap-3">
                            <div>
                                <x-label for="faqQuestion{{ $i }}" value="{{ __('modules.settings.question') }}" />
                                <x-input id="faqQuestion{{ $i }}" class="block mt-1 w-full" type="text" wire:model.defer="data.faq.items.{{ $i }}.question" />
                            </div>
                            <div>
                                <x-label for="faqAnswer{{ $i }}" value="{{ __('modules.settings.answer') }}" />
                                <x-textarea id="faqAnswer{{ $i }}" class="block mt-1 w-full" wire:model.defer="data.faq.items.{{ $i }}.answer"></x-textarea>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- CTA --}}
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <h3 class="mb-4 text-lg font-semibold dark:text-white">@lang('modules.settings.ctaSection')</h3>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <x-label for="ctaSubtitle" value="{{ __('modules.settings.subtitle') }}" />
                    <x-input id="ctaSubtitle" class="block mt-1 w-full" type="text" wire:model.defer="data.cta.subtitle" />
                </div>
                <div>
                    <x-label for="ctaButton" value="{{ __('modules.settings.button') }}" />
                    <x-input id="ctaButton" class="block mt-1 w-full" type="text" wire:model.defer="data.cta.button" />
                </div>
                <div class="md:col-span-2">
                    <x-label for="ctaTitle" value="{{ __('modules.settings.title') }}" />
                    <x-input id="ctaTitle" class="block mt-1 w-full" type="text" wire:model.defer="data.cta.title" />
                </div>
                <div class="md:col-span-2">
                    <x-label for="ctaText" value="{{ __('modules.settings.description') }}" />
                    <x-textarea id="ctaText" class="block mt-1 w-full" wire:model.defer="data.cta.text"></x-textarea>
                </div>
            </div>
        </div>

        {{-- Contact --}}
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <h3 class="mb-4 text-lg font-semibold dark:text-white">@lang('modules.settings.contactSection')</h3>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <x-label for="contactSubtitle" value="{{ __('modules.settings.subtitle') }}" />
                    <x-input id="contactSubtitle" class="block mt-1 w-full" type="text" wire:model.defer="data.contact.subtitle" />
                </div>
                <div>
                    <x-label for="contactTitle" value="{{ __('modules.settings.title') }}" />
                    <x-input id="contactTitle" class="block mt-1 w-full" type="text" wire:model.defer="data.contact.title" />
                </div>
                <div>
                    <x-label for="contactEmail" value="{{ __('modules.settings.email') }}" />
                    <x-input id="contactEmail" class="block mt-1 w-full" type="email" wire:model.defer="data.contact.email" />
                </div>
                <div>
                    <x-label for="contactPhone" value="{{ __('modules.settings.phone') }}" />
                    <x-input id="contactPhone" class="block mt-1 w-full" type="text" wire:model.defer="data.contact.phone" />
                </div>
                <div class="md:col-span-2">
                    <x-label for="contactAddress" value="{{ __('modules.settings.address') }}" />
                    <x-input id="contactAddress" class="block mt-1 w-full" type="text" wire:model.defer="data.contact.address" />
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <h3 class="mb-4 text-lg font-semibold dark:text-white">@lang('modules.settings.footerSection')</h3>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="md:col-span-2">
                    <x-label for="footerText" value="{{ __('modules.settings.footerText') }}" />
                    <x-textarea id="footerText" class="block mt-1 w-full" wire:model.defer="data.footer.text"></x-textarea>
                </div>
                <div>
                    <x-label for="footerLocation" value="{{ __('modules.settings.location') }}" />
                    <x-input id="footerLocation" class="block mt-1 w-full" type="text" wire:model.defer="data.footer.location" />
                </div>
                <div>
                    <x-label for="footerEmail" value="{{ __('modules.settings.email') }}" />
                    <x-input id="footerEmail" class="block mt-1 w-full" type="email" wire:model.defer="data.footer.email" />
                </div>
                <div>
                    <x-label for="footerPhone" value="{{ __('modules.settings.phone') }}" />
                    <x-input id="footerPhone" class="block mt-1 w-full" type="text" wire:model.defer="data.footer.phone" />
                </div>
                <div>
                    <x-label for="footerLogo" value="{{ __('modules.settings.logo') }}" />
                    <input type="file" id="footerLogo" wire:model="footerLogo"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-skin-base/10 file:text-skin-base hover:file:bg-skin-base/20">
                    @if (!empty($data['footer']['logo']))
                        <div class="mt-2 flex items-center gap-3">
                            <img src="{{ asset_url_local_s3('landing_home/' . $data['footer']['logo']) }}" class="w-32 rounded" alt="">
                            <button type="button" wire:click="removeImage('footer.logo')" class="text-sm text-red-600">@lang('app.remove')</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="md:col-span-2 mt-4">
            <x-button>@lang('app.save')</x-button>
        </div>

    </form>

</div>
