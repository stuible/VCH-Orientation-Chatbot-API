<template>
<v-combobox
      v-model="model"
      :items="items"
      hide-selected
      hide-details
      label="Synonyms"
      multiple
      small-chips

    >
      <!-- <template slot="no-data">
        <v-list-tile>
          <span class="subheading">Create</span>
          <v-chip
            :color="`teal lighten-3`"
            label
            small
          >
          </v-chip>
        </v-list-tile>
      </template> -->
      <template
        v-if="item === Object(item)"
        slot="selection"
        slot-scope="{ item, parent, selected }"
        label

      >
        <v-chip
          :color="`${item.color} lighten-3`"
          :selected="selected"
          small
        >
          <span class="pr-2">
            {{ item.text }}
          </span>
          <v-icon
            small
            @click="parent.selectItem(item)"
          >close</v-icon>
        </v-chip>
      </template>
      <!-- <template
        slot="item"
        slot-scope="{ index, item, parent }"
      >
        <v-list-tile-content>
          <v-text-field
            v-if="editing === item"
            v-model="editing.text"
            autofocus
            flat
            background-color="transparent"
            hide-details
            solo
            @keyup.enter="edit(index, item)"
          ></v-text-field>
          <v-chip
            v-else
            :color="`${item.color} lighten-3`"
            dark
            label
            small
          >
            {{ item.text }}
          </v-chip>
        </v-list-tile-content>
        <v-spacer></v-spacer>
        <v-list-tile-action @click.stop>
          <v-btn
            icon
            @click.stop.prevent="edit(index, item)"
          >
            <v-icon>{{ editing !== item ? 'edit' : 'check' }}</v-icon>
          </v-btn>
        </v-list-tile-action>
      </template> -->
</v-combobox>
</template>

<script>
export default {
    props: ['synonyms'],
    data() {
        return {
            loading: false,
            activator: null,
            attach: null,
            colors: ['cyan', 'teal'],
            editing: null,
            index: -1,
            items: [
                ],
                nonce: 1,
                menu: false,
                model: [
                ],
            x: 0,
            search: null,
            y: 0
        }
    },
    computed: {
        // formTitle () {
        // return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
        // }
    },
    created() {
        this.fetchSynonyms();
    },

    watch: {
    model (val, prev) {
      if (val.length === prev.length) return

      this.model = val.map(v => {
        if (typeof v === 'string') {
          v = {
            text: v,
            color: this.colors[this.nonce - 1]
          }

          this.items.push(v)

          this.nonce++
        }

        return v
      })
    }
  },

  methods: {
    edit (index, item) {
      if (!this.editing) {
        this.editing = item
        this.index = index
      } else {
        this.editing = null
        this.index = -1
      }
    },
    filter (item, queryText, itemText) {
      if (item.header) return false

      const hasValue = val => val != null ? val : ''

      const text = hasValue(itemText)
      const query = hasValue(queryText)

      return text.toString()
        .toLowerCase()
        .indexOf(query.toString().toLowerCase()) > -1
    },
    fetchSynonyms() {
            this.loading = true;
            fetch('api/intents/' + this.intent + '/slots/' + this.slot + '/synonyms')
                .then(res => res.json())
                .then(res => {
                    this.items = res.data;
                    this.loading = false;
                })
        },
  }
}
</script>
