import { PageProps as InertiaPageProps } from '@inertiajs/core'

export interface PageProps extends InertiaPageProps {
    session: {
        token: string | null
        token_expires_at: string | null
        refresh_token: string | null
    }
}
