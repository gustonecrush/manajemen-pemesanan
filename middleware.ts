import { NextResponse } from 'next/server'

export function middleware(request: any) {
  const XSRF092 = request.cookies.get('XSRF092')
  const XSRF081 = request.cookies.get('XSRF081')

  if (!XSRF081) {
    const protectedPaths = [
      '/dashboard/complete-profile',
      '/dashboard'
    ]

    if (protectedPaths.includes(request.nextUrl.pathname)) {
      return NextResponse.redirect(new URL('/', request.url))
    }
  } else {
    const protectedPaths = [
      '/registrasi',
      '/login'
    ]

    if (protectedPaths.includes(request.nextUrl.pathname)) {
      return NextResponse.redirect(new URL('/dashboard', request.url))
    }
  }

  if (!XSRF092) {
    const protectedPaths = [
      '/admin/operator/dashboard',
      '/admin/operator/pemesanan',
      '/admin/operator/pelatihan/tambah-pelatihan',
      '/admin/operator/pelatihan/penerbitan-sttpl',
    ]

    if (protectedPaths.includes(request.nextUrl.pathname)) {
      return NextResponse.redirect(new URL('/', request.url))
    }
  } else {
    const protectedPaths = ['/admin/auth/login']

    if (protectedPaths.includes(request.nextUrl.pathname)) {
      return NextResponse.redirect(
        new URL('/admin/operator/pemesanan', request.url),
      )
    }
  }

}
