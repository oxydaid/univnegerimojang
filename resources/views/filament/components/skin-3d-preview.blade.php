<div class="mt-2 text-center" x-data="{
    viewer: null,
    init() {
        this.loadViewer();
    },
    loadViewer() {
        if (!window.skinview3d) {
            setTimeout(() => this.loadViewer(), 100);
            return;
        }
        const canvas = this.$refs.skinCanvas;
        const skinUrl = '{{ $skinUrl }}' || 'https://crafatar.com/skins/default';
        
        try {
            this.viewer = new window.skinview3d.SkinViewer({
                canvas: canvas,
                width: 160,
                height: 200,
                skin: skinUrl
            });
            this.viewer.zoom = 0.85;
            this.viewer.autoRotate = true;
            this.viewer.autoRotateSpeed = 1.0;
        } catch (e) {
            console.error('Error starting 3D skin viewer:', e);
        }
    }
}">
    @vite(['resources/js/app.js'])
    <div class="mx-auto border-2 border-slate-900 bg-slate-100 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] w-[160px] h-[200px] overflow-hidden flex items-center justify-center">
        <canvas x-ref="skinCanvas" width="160" height="200" class="w-[160px] h-[200px]"></canvas>
    </div>
</div>
