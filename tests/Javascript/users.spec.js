import { mount } from 'vue-test-utils'
import expect from 'expect'
import Users from '../../resources/assets/js/components/Users.vue'
import moxios from 'moxios'

describe('Users', () => {

  let component
  const USERS = [
    {
      id: 1,
      name: "prova1",
      email: 'prova@gmail.com'
    },

    {
      id: 2,
      name: "prova2",
      email: 'prova2@gmail.com'
    },
    {
      id: 3,
      name: "prova3",
      email: 'prova3@gmail.com'
    }
  ]

  beforeEach(() => {
    component = mount(Users)
      moxios.install()
  })

  afterEach( () =>{
    moxios.uninstall();
  })
  it('expect users empty', () => {
    expect(component.vm.users).toEqual([])

  })

  it('contains Users', () => {
    expect(component.html()).toContain('Users (0):')
  })

  it('contains correct number of users after mount', done =>{

    //prepare
    moxios.stubRequest('/api/v1/users',{
      status: 200,
      response: USERS
    })

    //execute

    //assert
    moxios.wait(()=>{

      expect(component.vm.users).toEqual(USERS)
      expect(component.html()).toContain('Users (3):')
      done()
    })
  })

})