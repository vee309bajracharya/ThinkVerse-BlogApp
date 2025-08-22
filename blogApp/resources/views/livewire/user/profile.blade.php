<section class="row">

    {{-- users tab left --}}
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
        <div class="pd-20 card-box height-100-p">

            <div class="relative">
                <a href="{{ route('user.edit_profile') }}"
                   class="absolute top-1 right-3 rounded-md p-1.5">
                    <i class="fa fa-pencil text-sm"></i>
                </a>
                <img src="{{ $user->picture }}"
                     alt=""
                     class="w-full h-full object-cover rounded-md bg-amber-50" />
            </div>
            

            <h5 class="text-center h5 mt-3">{{ $user->name }}</h5>
            <div class="text-center">
                <ul class="flex justify-center space-x-2">
                    @if($user->social_links && $user->social_links->fb_url)
                    <li>
                        <a
                            href="{{ $user->social_links->fb_url }}"
                            target="_blank"
                            class="btn"
                            data-color="#000">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    @endif
            
                    @if($user->social_links && $user->social_links->insta_url)
                    <li>
                        <a
                            href="{{ $user->social_links->insta_url }}"
                            target="_blank"
                            class="btn"
                            data-color="#000"
                        >
                            <i class="fa fa-instagram"></i>
                        </a>
                    </li>
                    @endif
            
                    @if($user->social_links && $user->social_links->github_url)
                    <li>
                        <a
                            href="{{ $user->social_links->github_url }}"
                            target="_blank"
                            class="btn"
                            data-color="#000"
                        >
                            <i class="fa fa-github"></i>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            


            {{-- profile details here --}}
            <div class="profile-info my-3">
                <h5 class="mb-20 h5">Your Details</h5>
                <ul>
                    <li>
                        <span>Username</span>
                        {{ $user->username }}
                    </li>
                    <li>
                        <span>Email Address</span>
                        {{ $user->email }}
                    </li>
                    <li class="text-left">
                        <span>Bio</span>
                        {{ $user->bio }}
                    </li>

                </ul>
            </div>
        </div>
    </div>


    {{-- users tabs right --}}
    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
        <div class="card-box height-100-p overflow-hidden">
            <div class="profile-tab height-100-p">
                <div class="tab height-100-p">
                    <ul class="nav nav-tabs customtab" role="tablist">
                        <li class="nav-item">
                            <a wire:click="selectTab('personal_details')"
                                class="nav-link {{ $tab == 'personal_details' ? 'active' : '' }}" data-toggle="tab"
                                href="" role="tab">Personal
                                Details</a>
                        </li>
                        <li class="nav-item">
                            <a wire:click="selectTab('update_password')"
                                class="nav-link {{ $tab == 'update_password' ? 'active' : '' }}" data-toggle="tab"
                                href="" role="tab">Update Password</a>
                        </li>
                        <li class="nav-item">
                            <a wire:click="selectTab('social_links')"
                                class="nav-link {{ $tab == 'social_links' ? 'active' : '' }}" data-toggle="tab"
                                href="" role="tab">Social Links</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade {{ $tab == 'personal_details' ? 'show active' : '' }}" id="timeline"
                            role="tabpanel">
                            <div class="pd-20">
                                <div class="profile-timeline" role="tabpanel">
                                    <div class="pd-10">
                                        {{-- personal details form --}}
                                        <h4 class="text-blue  mb-20">
                                            Edit Your Personal Details
                                        </h4>
                                        <form wire:submit="updatePersonalDetails()">


                                            <section class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="fullName">Full Name</label>
                                                        <input type="text" class="form-control" wire:model="name"
                                                            placeholder="">
                                                        @error('name')
                                                            <p x-data="{ show: true }" x-show="show"
                                                                x-init="setTimeout(() => show = false, 5000)" x-transition.opacity.duration.500ms
                                                                class="error-msg text-sm text-[var(--danger)] font-medium mt-1">
                                                                {{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">

                                                        <label for="username">Username</label>
                                                        <input type="text" class="form-control" wire:model="username"
                                                            placeholder="">
                                                        @error('username')
                                                            <p x-data="{ show: true }" x-show="show"
                                                                x-init="setTimeout(() => show = false, 5000)" x-transition.opacity.duration.500ms
                                                                class="error-msg text-sm text-[var(--danger)] font-medium mt-1">
                                                                {{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">

                                                        <label for="email">Email</label>
                                                        <input type="text" class="form-control" wire:model="email"
                                                            placeholder="">
                                                        @error('email')
                                                            <p x-data="{ show: true }" x-show="show"
                                                                x-init="setTimeout(() => show = false, 5000)" x-transition.opacity.duration.500ms
                                                                class="error-msg text-sm text-[var(--danger)] font-medium mt-1">
                                                                {{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="bio">Bio</label>
                                                        <textarea wire:model="bio" cols="1" rows="1" class="form-control" placeholder="Tell about yourself"></textarea>
                                                        @error('bio')
                                                            <p x-data="{ show: true }" x-show="show"
                                                                x-init="setTimeout(() => show = false, 5000)" x-transition.opacity.duration.500ms
                                                                class="error-msg text-sm text-[var(--danger)] font-medium mt-1">
                                                                {{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </section>

                                            <div>
                                                <button type="submit" class="btnPers w-40">Save Changes</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- pwd form --}}
                        <div class="tab-pane fade {{ $tab == 'update_password' ? 'show active' : '' }}"
                            id="timeline" role="tabpanel">
                            <div class="pd-20">
                                <div class="profile-timeline" role="tabpanel">
                                    <div class="pd-20">
                                        <form wire:submit="updatePassword()">
                                            <div class="w-2/3 flex flex-col">

                                                {{-- current pwd --}}
                                                <div class="mb-2">
                                                    <label for="current_password">Current Password</label>
                                                    <input type="password" class="form-control"
                                                        wire:model="current_password">
                                                    @error('current_password')
                                                        <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                                                            x-transition.opacity.duration.500ms
                                                            class="error-msg text-sm text-[var(--danger)] font-medium mt-1">
                                                            {{ $message }}</p>
                                                    @enderror
                                                </div>

                                                {{-- new password --}}
                                                <div class="my-2">
                                                    <label for="new_password">New Password</label>
                                                    <input type="password" class="form-control"
                                                        wire:model="new_password">
                                                    @error('new_password')
                                                        <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                                                            x-transition.opacity.duration.500ms
                                                            class="error-msg text-sm text-[var(--danger)] font-medium mt-1">
                                                            {{ $message }}</p>
                                                    @enderror
                                                </div>

                                                {{-- confirm new password --}}
                                                <div class="my-2">
                                                    <label for="new_password_confirmation">Confirm New Password</label>
                                                    <input type="password" class="form-control"
                                                        wire:model="new_password_confirmation">
                                                    @error('new_password_confirmation')
                                                        <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                                                            x-transition.opacity.duration.500ms
                                                            class="error-msg text-sm text-[var(--danger)] font-medium mt-1">
                                                            {{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <button type="submit" class="btnPers w-40">Update Password</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <section class="tab-pane fade {{ $tab == 'social_links' ? 'show active' : '' }}" id="timeline"
                            role="tabpanel">
                            <div class="pd-20">
                                <div class="profile-timeline" role="tabpanel">
                                    <div class="pd-20">
                                        <form wire:submit="updateSocialLinks()" method="POST">
                                            <section class="w-2/3 flex flex-col">
                                                
                                                <div class="mb-2">
                                                    <label for="fb_url">Facebook URL</label>
                                                    <input type="text" class="form-control"
                                                        wire:model="fb_url">
                                                    @error('fb_url')
                                                        <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                                                            x-transition.opacity.duration.500ms
                                                            class="error-msg text-sm text-[var(--danger)] font-medium mt-1">
                                                            {{ $message }}</p>
                                                    @enderror
                                                </div>
    
                                                <div class="my-2">
                                                    <label for="insta_url">Instagram URL</label>
                                                    <input type="text" class="form-control"
                                                        wire:model="insta_url">
                                                    @error('insta_url')
                                                        <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                                                            x-transition.opacity.duration.500ms
                                                            class="error-msg text-sm text-[var(--danger)] font-medium mt-1">
                                                            {{ $message }}</p>
                                                    @enderror
                                                </div>
    
                                                <div class="my-2">
                                                    <label for="github_url">GitHub URL</label>
                                                    <input type="text" class="form-control"
                                                        wire:model="github_url">
                                                    @error('github_url')
                                                        <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                                                            x-transition.opacity.duration.500ms
                                                            class="error-msg text-sm text-[var(--danger)] font-medium mt-1">
                                                            {{ $message }}</p>
                                                    @enderror
                                                </div>
    
                                                <div class="mt-4">
                                                    <button type="submit" class="btnPers w-40">Update Links</button>
                                                </div>
                                         
                                            </section>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </section>
                    </div>
                </div>
            </div>
</section>
