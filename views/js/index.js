let app = new Vue({
  el: '#app',
  data() {
    return {
      showForm: false,
      user_name: null,
      user_email: null,
      comment_title: null,
      comment_text: null,
      errors: [],
      showForm__btn: true,
      dataComment: [],
      sortBtn: false
    }
  },
  methods: {
    sendComment() {
      this.validationForm()
      if (this.errors.length === 0) this.requestFetch()
    },
    // Валидация формы
    validationForm() {
      this.errors = []
      if (!this.user_name || (this.user_name.length < 3) || (this.user_name.length > 50)) {
        this.errors.push('Поле "Имя" - указано не верно!')
      }

      if (!this.user_email ||
        !this.user_email.match(/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/gi)
        || (this.user_email.length < 3)
        || (this.user_email.length > 50)) {
        this.errors.push('Указан неверный "E-mail" !')
      }

      if (!this.comment_title || (this.comment_title.length < 3) || (this.comment_title.length > 50)) {
        this.errors.push('"Заголовок" - должен быть больше 3 символов и меньше 50!')
      }

      if (!this.comment_text || (this.comment_text.length < 3) || (this.comment_text.length > 500)) {
        this.errors.push('"Комментарий" - должен быть больше 3 символов но меньше 500!')
      }
    },
    // Пишем комментарий в БД
    requestFetch() {
      const data = `user_name=${this.user_name}&user_email=${this.user_email}&comment_title=${this.comment_title}&comment_text=${this.comment_text}`
      fetch('/Comment/write_comment',
        {
          method: 'POST',
          body: data,
          headers: {'content-type': 'application/x-www-form-urlencoded'}
        })
        .then(response => {
          if (response.status !== 200) {
            return Promise.reject()
          }
          return response.json()
        })
        .then(response => {
          if (Number.isInteger(response) && response > 0) {
            this.showForm = false
            this.user_name = null
            this.user_email = null
            this.comment_title = null
            this.comment_text = null
            this.getDataComment()
            alert('Комментарий добавлен.')
          }
          //console.log(response)
          //return data
        })
        .catch((e) => console.log(e, 'ошибка'))

    },
    // Для загрузки комментариев из БД
    getDataComment () {
      fetch('/Comment/getComment',
        {
          method: 'GET',
          headers: {'content-type': 'application/x-www-form-urlencoded'}
        })
        .then(response => {
          if (response.status !== 200) {
            return Promise.reject()
          }
          return response.json()
        })
        .then(response => {
          this.dataComment = response
          //console.log(response)
          //return data
        })
        .catch((e) => console.log(e, 'ошибка'))
    },
    // Сортировка
    sortData () {
      let arr = this.dataComment
      this.dataComment = []
      this.dataComment = arr.reverse()
      this.sortBtn = !this.sortBtn
    }
  },
  created () {
    // Загружаю комментарии из БД до ототображения контента на странице
    this.getDataComment()
  }
})